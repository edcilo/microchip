<?php

use microchip\pay\PayRepo;
use microchip\sale\SaleRepo;
use microchip\company\CompanyRepo;
use microchip\coupon\CouponRepo;
use microchip\configuration\ConfigurationRepo;
use microchip\customer\CustomerRepo;

use microchip\pay\PayRegManager;
use microchip\pay\PayUpdManager;
use microchip\pay\PayRegisterOutManager;
use microchip\pay\PayRegisterInManager;
use microchip\pay\PayUpdInManager;
use microchip\pay\PayUpdOutManager;
use microchip\pay\PayRegisterOutSaleManager;
use microchip\pay\PayChangeRegisterManager;

use microchip\helpers\NumberToLetter;

class PayController extends \BaseController {

    protected $payRepo;
    protected $saleRepo;
    protected $companyRepo;
    protected $couponRepo;
    protected $configRepo;
    protected $customerRepo;

    public function __construct(
        PayRepo             $payRepo,
        SaleRepo            $saleRepo,
        CompanyRepo         $companyRepo,
        CouponRepo          $couponRepo,
        ConfigurationRepo   $configurationRepo,
        CustomerRepo        $customerRepo
    )
    {
        $this->payRepo      = $payRepo;
        $this->saleRepo     = $saleRepo;
        $this->companyRepo  = $companyRepo;
        $this->couponRepo   = $couponRepo;
        $this->configRepo   = $configurationRepo;
        $this->customerRepo = $customerRepo;
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
        $cancellations = $this->saleRepo->getPendingCancellations(false);

        if(Request::ajax())
        {
            return Response::json($sales);
        }

        return View::make('pay/pays_pending', compact('sales', 'orders', 'services', 'cancellations'));
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
		$sale   = $this->saleRepo->find($sale_id);
        $this->notFoundUnless($sale);

        $rest   = $sale->getUserRestTotalAttribute();

        if ($rest > 0) {
            $data            = Input::all();
            if ($data['method'] != 'Vale' AND $data['method'] != 'Monedero') {
                $data['change']  = ($data['amount'] > $rest) ? $data['amount'] - $rest : 0;
                $data['total']   = $rest;
                $data['sale_id'] = $sale_id;
                $data['user_id'] = Auth::user()->id;

                $pay = $this->payRepo->newPay();
                $manager = new PayRegManager($pay, $data);
                $manager->save();

                $amount = $pay->amount;
            } elseif ($data['method'] == 'Vale') {
                $validator = Validator::make($data, [
                    'method'    => 'required',
                    'folio'     => 'required|exists:coupons,folio',
                ]);

                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }

                $coupon = $this->couponRepo->find($data['folio']);

                if (! $coupon->available) {
                    return Redirect::back()->withINput()->withErrors(['folio' => "El vale $coupon->folio ya fue utilizado."]);
                }

                if ($coupon->lapsed) {
                    return Redirect::back()->withINput()->withErrors(['folio' => "El vale $coupon->folio ya esta vencido."]);
                }

                $pay = $this->payRepo->newPay();
                $pay->amount = $coupon->value;
                $pay->change = 0;
                $pay->description = 'Pago con vale.';
                $pay->method = 'Vale';
                $pay->sale_id = $sale_id;
                $pay->user_id = Auth::user()->id;
                $pay->coupon_id = $coupon->id;
                $pay->date = date('Y-m-d');
                $pay->save();

                $coupon->available = 0;
                $coupon->save();

                $amount = $coupon->value;
            } else {
                $validator = Validator::make($data, [
                    'method'    => 'required',
                    'reference' => 'required|exists:customers,card_id',
                ]);

                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }

                $customer = $this->customerRepo->getByCard($data['reference']);
                $points = $customer->points;

                if ($points <= 0) {
                    return Redirect::back()->withINput()->withErrors(['reference' => "El monedero no tiene puntos a favor."]);
                }

                if ($customer->expiration_date == 'Vencido') {
                    return Redirect::back()->withINput()->withErrors(['reference' => "El monedero ha expirado."]);
                }

                $amount = ($rest > $points) ? $points : $rest;

                $pay = $this->payRepo->newPay();
                $pay->amount = $amount;
                $pay->change = 0;
                $pay->description = 'Pago con monedero.';
                $pay->method = 'Monedero';
                $pay->sale_id = $sale_id;
                $pay->user_id = Auth::user()->id;
                $pay->date = date('Y-m-d');
                $pay->save();

                $customer->points -= $amount;
                $customer->save();
            }

            if (($rest - $amount) <= 0) {
                $sale->status = 'Pagado';
                $sale->save();
            }
        } else {
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

        if ($pay->sale->status == 'Cancelado') {
            return Redirect::back()->with('message', 'No es posible editar el pago de una venta cancelada');
        }

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

        if ($pay->sale->status == 'Cancelado') {
            return Redirect::back()->with('message', 'No es posible editar el pago de una venta cancelada');
        }

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

        if ($pay->sale->status == 'Cancelado') {
            if ( Request::ajax() )
            {
                $response = $this->msg304 + [ 'data' => $pay->sale ];

                return Response::json($response);
            }

            return Redirect::back()->with('message', 'No es posible eliminar el pago de una venta cancelada');
        }

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

        if ($sale->customer->card_id) {
            $sale->customer->points += $total;
        }

        if (
            $sale->customer->referrer AND
            $sale->customer->referrer->customer->card_id AND
            $sale->customer->referrer->expiration_date != 'Vencido'
        ) {
            $sale->customer->referrer->customer->points += $total_r;
        }

        $sale->push();
    }

    public function repayment($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        return View::make('pay.repayment', compact('sale'));
    }

    public function repaymentStore($id, $method)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        $success = false;
        $coupon_id = 0;
        $message = "No se pudo registrar la devolución.";

        if ($method == 'repayment') {
            $pay = $this->payRepo->newPay();
            $pay->amount    = -1 * $sale->user_total_pay;
            $pay->method    = 'Efectivo';
            $pay->sale_id   = $sale->id;
            $pay->user_id   = Auth::user()->id;
            $pay->date      = date('Y-m-d');
            $pay->save();

            $success = true;
            $message = "Se registro correctamente la devolución en efectivo por la cantidad de $ $sale->user_total_pay_f.";
        } elseif ($method == 'card') {
            $sale->customer->points += $sale->user_total_pay;

            $success = true;
            $message = "El rembolso de $ $sale->user_total_pay_f se agrego al monedero del cliente correctamente.";
        } elseif ($method == 'coupon') {
            $config = $this->configRepo->find(1);

            $coupon = $this->couponRepo->newCoupon();
            $coupon->value          = $sale->user_total_pay;
            $coupon->effective_days = $config->coupon_effective_days;
            $coupon->customer_id    = $sale->customer->id;
            $coupon->sale_id        = $sale->id;
            $coupon->user_id        = Auth::user()->id;
            $coupon->save();

            $coupon->folio          = str_pad($coupon->id, 8, '0', STR_PAD_LEFT);
            $coupon->save();

            $success = true;
            $message = "El vale por $ $sale->user_total_pay_f se registro correctamente.";
            $coupon_id = $coupon->id;
        }

        if ($success) {
            $sale->repayment = 1;
            $sale->push();
        }

        return Redirect::back()->with(['message' => $message, 'coupon_id' => $coupon_id]);
    }

    public function printDocument($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        $company	= $this->companyRepo->find(1);

        $no2letter          = new NumberToLetter();
        $sale->total_text   = strtoupper( $no2letter->ValorEnLetras($sale->user_total_pay, 'pesos') );
        $concept            = 'Cancelación de '. $sale->classification .' con folio ' . $sale->folio;

        $pdf = PDF::loadView('pay/layout_print', compact('sale', 'concept', 'company'))->setPaper('letter');
        return $pdf->stream();
    }

}