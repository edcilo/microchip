<?php

use microchip\pay\PayRepo;
use microchip\sale\SaleRepo;

use microchip\pay\PayRegManager;
use microchip\pay\PayUpdManager;
use microchip\pay\PayRegisterOutManager;
use microchip\pay\PayRegisterInManager;
use microchip\pay\PayUpdInManager;
use microchip\pay\PayUpdOutManager;
use microchip\pay\PayRegisterOutSaleManager;
use microchip\pay\PayChangeRegisterManager;

class PayController extends \BaseController {

    protected $payRepo;
    protected $saleRepo;

    public function __construct(
        PayRepo     $payRepo,
        SaleRepo    $saleRepo
    )
    {
        $this->payRepo  = $payRepo;
        $this->saleRepo = $saleRepo;
    }

	/**
	 * Display a listing of the resource.
	 * GET /pay
	 *
	 * @return Response
	 */
	public function index()
	{
        if ( Request::ajax() ) return $this->payRepo->getAll('all', 'id', 'ASC');

        $pays = $this->payRepo->getAll('paginate', 'id', 'desc');
        $pending = $this->payRepo->getPending();

        return View::make('pay/index', compact('pays', 'pending'));
	}

    public function pending()
    {
        $sales = $this->saleRepo->getByClassificationStatus('Venta', 'Emitido');
        $orders = $this->saleRepo->getByClassificationStatus('Pedido', 'Emitido');
        $services = $this->saleRepo->getByClassificationStatus('Servicio', 'Emitido');

        if(Request::ajax())
        {
            return Response::json($sales);
        }

        return View::make('pay/pays_pending', compact('sales', 'orders', 'services'));
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /pay/create
	 *
	 * @return Response
	 */
	public function create($sale_id)
	{
        $sale = $this->saleRepo->find($sale_id);
        $this->notFoundUnless($sale);

		return View::make('pay/create', compact('sale'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /pay
	 *
	 * @return Response
	 */
	public function store($sale_id)
	{
		$sale = $this->saleRepo->find($sale_id);
        $this->notFoundUnless($sale);

        $rest = $sale->getUserRestTotalAttribute();

        if($rest > 0)
        {
            $data            = Input::all();
            $data['change']  = ($data['amount'] > $rest) ? $data['amount'] - $rest : 0;
            $data['total']   = $rest;
            $data['sale_id'] = $sale_id;
            $data['user_id'] = Auth::user()->id;

            $pay = $this->payRepo->newPay();
            $manager = new PayRegManager($pay, $data);
            $manager->save();

            if($rest - $pay->amount <= 0)
            {
                $sale->status = 'Pagado';
                $sale->save();
            }
        }
        else
        {
            $sale->status = 'Pagado';
            $sale->save();
        }

        $message = ['success' => 'El pago se registro correctamente'];

        if(Request::ajax())
        {
            return Response::json($this->msg200 + $message);
        }

        if($sale->status == 'Pagado')
        {
            $this->addPoints($sale);

            return Redirect::route('pay.pending')->with($message);
        }

        return Redirect::back()->with($message);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /pay/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $pay = $this->payRepo->find($id);
        $this->notFoundUnless($pay);

        $sale = $pay->sale;

        return View::make('pay/edit', compact('pay', 'sale'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /pay/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$pay = $this->payRepo->find($id);
        $this->notFoundUnless($pay);

        $data = Input::all();
        $data['user_id'] = Auth::user()->id;
        $data['change']  = ($data['amount'] > ($pay->sale->getUserRestTotalAttribute() + $pay->amount)) ? $data['amount'] - $pay->sale->getUserRestTotalAttribute() : 0;

        $manager = new PayUpdManager($pay, $data);
        $manager->save();

        $pay = $this->payRepo->find($id);
        $this->modifiedStatus($pay);

        if ( Request::ajax() )
        {
            $response = $this->msg200 + [ 'data' => $pay ];

            return Response::json($response);
        }

        return Redirect::route('sale.show', [$pay->sale->folio, $pay->sale->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /pay/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$pay = $this->payRepo->find($id);
        $this->notFoundUnless($pay);

        $this->payRepo->destroy($id);

        $this->modifiedStatus($pay);

        if ( Request::ajax() )
        {
            $response = $this->msg200 + [ 'data' => $pay ];

            return Response::json($response);
        }

        if( $pay->sale )
            return Redirect::route('sale.show', [$pay->sale->folio, $pay->sale->id]);

        return Redirect::back();
	}

    public function modifiedStatus($pay)
    {
        if($pay->sale)
        {
            if($pay->sale->getUserRestTotalAttribute() > 0)
            {
                $pay->sale->status = 'Emitido';
            }
            else
            {
                $pay->sale->status = 'Pagado';
            }

            $pay->sale->save();
        }
    }

    public function free($sale_id)
    {
        $sale = $this->saleRepo->find($sale_id);
        $this->notFoundUnless($sale);

        if($sale->getUserRestTotalAttribute() == 0)
        {
            $sale->status = 'Pagado';
            $sale->save();

            $this->addPoints($sale);
        }

        $message = ['success' => "El documento $sale->folio se marco como pagado."];

        return Redirect::route('pay.pending')->with($message);
    }

    public function out()
    {
        return View::make('pay.create_out');
    }

    public function storeOut()
    {
        $data = Input::all();
        $data['user_id']    = Auth::user()->id;

        $pay = $this->payRepo->newPay();
        $manager = new PayRegisterOutManager($pay, $data);
        $manager->save();

        $message = ['success' => 'La salida se registro correctamente'];

        return Redirect::route('pay.pending')->with($message);
    }

    public function editOut($id)
    {
        $pay = $this->payRepo->find($id);
        $this->notFoundUnless($pay);

        $pay->amount *= -1;

        return View::make('pay.edit_out', compact('pay'));
    }

    public function updateOut($id)
    {
        $pay = $this->payRepo->find($id);
        $this->notFoundUnless($pay);

        $data = Input::all();
        $data['user_id'] = Auth::user()->id;

        $manager = new PayUpdOutManager($pay, $data);
        $manager->save();

        return Redirect::route('pay.index');
    }

    public function in()
    {
        return View::make('pay.create_in');
    }

    public function storeIn()
    {
        $data = Input::all();
        $data['user_id']    = Auth::user()->id;

        $pay = $this->payRepo->newPay();
        $manager = new PayRegisterInManager($pay, $data);
        $manager->save();

        $message = ['success' => 'La entrada se registro correctamente'];

        return Redirect::route('pay.pending')->with($message);
    }

    public function payOutSale()
    {
        return View::make('pay.create_out_sale');
    }

    public function payOutSaleStore()
    {
        $data = Input::all();
        $data['user_id'] = Auth::user()->id;

        $pay = $this->payRepo->newPay();
        $manager = new PayRegisterOutSaleManager($pay, $data);
        $manager->save();

        $message = ['success' => 'La salida se registro correctamente'];

        return Redirect::route('pay.pending')->with($message);
    }

    public function editIn($id)
    {
        $pay = $this->payRepo->find($id);
        $this->notFoundUnless($pay);

        return View::make('pay.edit_in', compact('pay'));
    }

    public function updateIn($id)
    {
        $pay = $this->payRepo->find($id);
        $this->notFoundUnless($pay);

        $data = Input::all();
        $data['user_id'] = Auth::user()->id;

        $manager = new PayUpdInManager($pay, $data);
        $manager->save();

        return Redirect::route('pay.index');
    }

    public function change($id)
    {
        $pay = $this->payRepo->find($id);
        $this->notFoundUnless($pay);

        $pay->amount *= -1;

        return View::make('pay.change', compact('pay'));
    }

    public function changeIn($id)
    {
        $pay = $this->payRepo->find($id);
        $this->notFoundUnless($pay);

        $manager = new PayChangeRegisterManager($pay, Input::all());
        $manager->save();

        return Redirect::route('pay.index');
    }

    public function addPoints($sale)
    {
        $sale->user->profile->current += $sale->getTotalAttribute();

        $total = 0;
        $total_r = 0;
        foreach ($sale->movements as $movement) {
            $points = $movement->selling_price * ($movement->product->points / 100);
            $total += $points;

            $points_r = $movement->selling_price * ($movement->product->r_points / 100);
            $total_r += $points_r;
        }

        $sale->customer->points += $total;

        if ($sale->customer->referrer AND $sale->customer->referrer->expiration_date != 'Vencido') {
            $sale->customer->referrer->customer->points += $total_r;
        }

        $sale->push();
    }

}