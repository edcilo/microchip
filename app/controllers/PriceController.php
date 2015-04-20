<?php

use microchip\sale\SaleRepo;
use microchip\configuration\ConfigurationRepo;
use microchip\company\CompanyRepo;
use microchip\pendingMovement\PendingMovementRepo;

use microchip\sale\SalePriceUpdManager;

class PriceController extends \BaseController {

    protected $saleRepo;
    protected $configRepo;
    protected $companyRepo;
    protected $paRepo;

    public function __construct(
        SaleRepo            $saleRepo,
        ConfigurationRepo   $configurationRepo,
        CompanyRepo         $companyRepo,
        PendingMovementRepo $pendingMovementRepo
    )
    {
        $this->saleRepo     = $saleRepo;
        $this->configRepo   = $configurationRepo;
        $this->companyRepo  = $companyRepo;
        $this->paRepo       = $pendingMovementRepo;
    }

	/**
	 * Display a listing of the resource.
	 * GET /price
	 *
	 * @return Response
	 */
	public function index()
	{
        if ( Request::ajax() ) return $this->saleRepo->getByClassification('Cotización', 'id', 'ASC', 'ajax');

        $prices = $this->saleRepo->getByClassification('Cotización', 'folio', 'DESC');

        return View::make('price/index', compact('prices'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /price/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $price   = $this->saleRepo->newSale();
        $global = $this->configRepo->first();

        $price->iva				= $global->iva;
        $price->dollar          = $global->dollar;
        $price->type			= 'Ticket';
        $price->classification	= 'Cotización';
        $price->status			= 'Pendiente';
        $price->delivery_date   = date('Y-m-d');
        $price->user_id			= Auth::user()->id;
        $price->customer_id		= 1;
        $price->price           = 1;
        $price->save();

        return Redirect::route('price.edit', [$price->id]);
	}

	/**
	 * Display the specified resource.
	 * GET /price/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $sale  = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        if ( Request::ajax() ) return Response::json($sale);

        return View::make('price/show', compact('sale'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /price/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        if ( $sale->status != 'Pendiente' ) return Redirect::route('home.sale');

        return View::make('price/edit', compact('sale'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /price/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $price = $this->saleRepo->find($id);
        $this->notFoundUnless($price);

        $folio = $this->saleRepo->getFolio('Cotización');

        $data = Input::all() + ['customer_order' => Input::get('customer_id'), 'folio' => str_pad($folio, 8, '0', STR_PAD_LEFT)];

        $manager = new SalePriceUpdManager($price, $data);
        $manager->save();

        if ( Request::ajax() ) {
            $response = $this->msg200 + [ 'data' => $price ];

            return Response::json($response);
        }

        return Redirect::route('price.print', [$price->folio, $price->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /price/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function pricePrint($folio, $id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        return View::make('price/print', compact('sale'));
    }

    public function generatePrint($id)
    {
        $price	= $this->saleRepo->find($id);
        $this->notFoundUnless($price);

        $company	= $this->companyRepo->find(1);

        $pdf = PDF::loadView('price/layoutPrint', compact('price', 'company'))->setPaper('letter');
        return $pdf->stream();
    }

    public function clonePrice($price_id)
    {
        $price = $this->saleRepo->find($price_id);
        $this->notFoundUnless($price);

        $clone = $this->saleRepo->newSale();
        $clone->iva             = $price->iva;
        $clone->dollar          = $price->dollar;
        $clone->classification  = $price->classification;
        $clone->status          = $price->status;
        $clone->description     = $price->description;
        $clone->new_price       = $price->new_price;
        $clone->separated       = $price->separated;
        $clone->price           = $price->price;
        $clone->customer_order  = $price->customer_order;
        $clone->movements_end   = $price->movements_end;
        $clone->customer_id     = $price->customer_id;
        $clone->user_id         = $price->user_id;
        $clone->save();

        foreach($price->pas as $pa)
        {
            $pa_c = $this->paRepo->newPA();
            $pa_c->barcode          = $pa->barcode;
            $pa_c->s_description    = $pa->s_description;
            $pa_c->l_description    = $pa->l_description;
            $pa_c->provider_link    = $pa->provider_link;
            $pa_c->image_link       = $pa->image_link;
            $pa_c->quantity         = $pa->quantity;
            $pa_c->quantity_price   = $pa->quantity_price;
            $pa_c->selling_price    = $pa->selling_price;
            $pa_c->w_iva            = $pa->w_iva;
            $pa_c->dollar           = $pa->dollar;
            $pa_c->utility          = $pa->utility;
            $pa_c->shipping         = $pa->shipping;
            $pa_c->soft_delete      = $pa->soft_delete;
            $pa_c->productOrder     = $pa->productOrder;
            $pa_c->productPrice     = $pa->productPrice;
            $pa_c->status           = $pa->status;
            $pa_c->product_id       = $pa->product_id;
            $pa_c->sale_id          = $clone->id;
            $pa_c->save();
        }

        return Redirect::route('price.edit', [$clone->id]);
    }



    public function toOrder($id)
    {
        $price = $this->saleRepo->find($id);
        $this->notFoundUnless($price);

        if($price->classification != 'Cotización')
        {
            $this->notFoundUnless(NULL);
        }

        $data = Input::get('quantity');
        foreach($data as $quantity)
        {
            $validator = Validator::make(
                ['quantity' => $quantity], ['quantity' => 'required|integer|min:1',]
            );

            if( $validator->fails() )
            {
                return Redirect::back()->withErrors($validator->messages());
            }
        }

        $ids        = ( is_null(Input::get('ids')) ) ? [] : Input::get('ids');
        $quantities = ( is_null(Input::get('quantity')) ) ? [] : Input::get('quantity');

        $c      = 0;
        $i      = 0;
        foreach($price->pas as $pa)
        {
            if( in_array($pa->id, $ids) )
            {
                $pa->quantity     = $quantities[$i];
                $pa->productOrder = 1;
                $pa->save();

                $c++;
            }

            $i++;
        }

        if( $c > 0 )
        {
            $price->status          = 'Pendiente';
            $price->classification  = 'Pedido';
            $price->separated       = 1;
            $price->save();

            if(Request::ajax())
                return Response::json($this->msg200 + [ 'data' => $price ]);

            Session::flash('success', 'Se creo la orden de pedido correctamente.');

            return Redirect::route('order.edit', [$price->id]);
        }

        $message = "No se selecciono ningún producto para surtir.";

        if ( Request::ajax() )
            return Response::json($this->msg200 + [ 'data' => $message ]);

        return Redirect::back()->with('message', $message);
    }


    public function toOrderOne($id)
    {
        $pa = $this->paRepo->find($id);
        $this->notFoundUnless($pa);

        $validator = Validator::make(
            Input::all(),
            ['quantity' => 'required|integer|min:1']
        );

        if( $validator->fails() )
        {
            return Redirect::back()->withErrors($validator->messages());
        }

        $pa->quantity     = Input::get('quantity');
        $pa->productOrder = 1;
        $pa->save();

        if(Request::ajax())
            return Response::json($this->msg200 + [ 'data' => $pa ]);

        return Redirect::back();
    }



    public function search($type)
    {
        $terms = \Input::get('terms');

        if ( Request::ajax() ) {
            return $this->saleRepo->search($terms, $type, 'ajax');
        }

        $results = $this->saleRepo->search($terms, $type);

        return View::make('price/search', compact('results', 'terms'));
    }

}