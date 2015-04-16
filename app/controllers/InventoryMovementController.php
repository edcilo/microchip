<?php

use microchip\inventoryMovement\InventoryMovementRepo;
use microchip\pendingMovement\PendingMovementRepo;
use microchip\series\SeriesRepo;
use microchip\product\ProductRepo;
use microchip\sale\SaleRepo;

use microchip\inventoryMovement\InventoryMovementRegManager;
use microchip\inventoryMovement\InventoryMovementPRegManager;
use microchip\inventoryMovement\InventoryMovementSRegManager;

class InventoryMovementController extends \BaseController {

	protected $movementRepo;
    protected $pendingRepo;
	protected $seriesRepo;
    protected $productRepo;
    protected $saleRepo;

	public function __construct(
		InventoryMovementRepo	$inventoryMovementRepo,
		SeriesRepo				$seriesRepo,
        PendingMovementRepo     $pendingMovementRepo,
        ProductRepo             $productRepo,
        SaleRepo                $saleRepo
	)
	{
		$this->movementRepo	= $inventoryMovementRepo;
		$this->seriesRepo	= $seriesRepo;
        $this->pendingRepo  = $pendingMovementRepo;
        $this->productRepo  = $productRepo;
        $this->saleRepo     = $saleRepo;
	}

	/**
	 * Display a listing of the resource.
	 * GET /movement
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( Request::ajax() ) return $this->movementRepo->getAll('all', 'id', 'ASC');

		$movements = $this->movementRepo->getAll('paginate', 'id', 'DESC');

		return View::make('movement/index', compact('movements'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /movement/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('movement/create');
	}

	public function store()
	{
		if (Input::get('status') == 'out')
		{
			$data 		= Input::all();
			$quantity	= $data['quantity'];
			$movements	= [];

			while ($quantity > 0)
			{
				$first 					= $this->movementRepo->firstIn($data['product_id']);
				$data['purchase_price']	= $first->purchase_price;
				$data['quantity'] 		= ($quantity > $first->in_stock) ? $first->in_stock : $quantity;

				$movement				= $this->movementRepo->newMovement();
				$manager				= new InventoryMovementRegManager($movement, $data);
				$manager->save();

				array_push($movements, $movement);

				$first->in_stock 	= ( $first->in_stock > $data['quantity'] ) ? $first->in_stock - $quantity : 0 ;
				$first->save();

				$quantity -= $movement->quantity;
			}
		}
		elseif(Input::get('status') == 'in')
		{
			$movement	= $this->movementRepo->newMovement();
			$manager	= new InventoryMovementRegManager($movement, Input::all());
			$manager->save();
		}

		if ( Request::ajax() ) {

			$response = ( isset($movements) ) ? $this->msg200 + [ 'data' => $movements ] : $this->msg200 + [ 'data' => $movement ];

			return Response::json($response);
		}

		return Redirect::route('movement.index')->with('message', 'El movimiento se registro correctamente.');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /movement/purchase
	 *
	 * @return Response
	 */
	public function purchaseStore()
	{
		$movement	= $this->movementRepo->newMovement();
		$manager	= new InventoryMovementPRegManager($movement, Input::all());
		$manager->save();

		$movement->purchases()->attach(Input::get('purchase_id'));

		if( $movement->product->p_description->have_series )
		{
			$movement->purchases[0]->progress_3 = 0;
			$movement->purchases[0]->save();
		}

		if ( Request::ajax() )
		{
			$response = $this->msg200 + [ 'data' => $movement ];

			return Response::json($response);
		}

		return Redirect::back();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /movement/purchase
	 *
	 * @return Response
	 */
	public function saleStore()
	{
		$validator = Validator::make(
			Input::all(), [
				'sale_id'		=> 'required|exists:sales,id',
				'product_id'	=> 'required|exists:products,id',
			]
		);

		if ($validator->fails())
        {
            return ( Request::ajax() ) ?
                Response::json($this->msg304 + [ 'data' =>  $validator->messages() ]) :
                Redirect::back()->withInput()->withErrors($validator->messages());
        }

        $sale       = $this->saleRepo->find(Input::get('sale_id'));
        if ( $sale->movements_end )
        {
            return Redirect::back()->with('msg', 'No es posible agregar mas productos.');
        }

        $total      = $this->movementRepo->totalStock(Input::get('product_id'));
        $product    = $this->productRepo->find(Input::get('product_id'));
        $iva        = $this->saleRepo->find(Input::get('sale_id'))->iva;

        $min_max    = ( $product->type == 'Producto' ) ? "|min:1|max:$total" : '';

        $validator = Validator::make(
            Input::all(),
            [
                'selling_price' => 'required|numeric|min:' . (number_format($product->price_5 * (($iva / 100) + 1), 2, '.', '')),
                'quantity'      => 'required|integer' . $min_max,
            ]
        );

        if ( $validator->fails() )
        {
            if ( Request::ajax() ) return Response::json($this->msg304 + [$validator->messages()] );

            return Redirect::back()->withInput()->withErrors($validator->messages());
        }

		$data 		            = Input::all();
        $data['iva']            = $iva;
        $data['total_in_stock'] = $total;

		$quantity	= $data['quantity'];
		$movements	= [];

		while ($quantity > 0)
		{
            if( $product->type == 'Producto' )
            {
                $first 					= $this->movementRepo->firstIn($data['product_id']);
                $data['purchase_price']	= $first->purchase_price;
                $data['movement_in_id'] = $first->id;

                $data['quantity'] 		= ($quantity > $first->in_stock) ? $first->in_stock : $quantity;
                $in_id                  = $first->id;
            } else {
                $data['purchase_price'] = 0;
                $in_id                  = 0;
            }

			$movement				= $this->movementRepo->newMovement();
			$manager				= new InventoryMovementSRegManager($movement, $data);
			$manager->save();

			array_push($movements, $movement);

			$movement->sales()->attach($data['sale_id'], ['movement_in'=>$in_id]);

            if( $product->type == 'Producto' )
            {
                if( $movement->product->p_description->have_series )
                {
                    $movement->sales[0]->series_end = 0;
                    $movement->sales[0]->save();
                }

                $first->in_stock 	= ( $first->in_stock > $data['quantity'] ) ? $first->in_stock - $quantity : 0 ;
                $first->save();
            }

			$quantity -= $movement->quantity;
		}

        return ( Request::ajax() ) ?
                Response::json($this->msg200 + [ 'data' => $movements ]) :
                Redirect::back();
	}

    public function prov_2_movement($id)
    {
        $pending = $this->pendingRepo->find($id);
        $this->notFoundUnless($pending);

        $total  = $this->movementRepo->totalStock(Input::get('product_id'));
        $data   = Input::all() + ['quantity'=>$pending->quantity];

        $validator = Validator::make(
            $data, [
                'product_id'	=> 'required|exists:products,id',
                'quantity'		=> 'required|integer|min:1|max:' . $total,
            ]
        );

        if ($validator->fails())
            return ( Request::ajax() ) ?
                Response::json($this->msg304 + [ 'data' =>  $validator->messages() ]) :
                Redirect::back()->withInput()->withErrors($validator->messages());

        $quantity	= $data['quantity'];
        $movements	= [];

        while ($quantity > 0)
        {
            $first 					= $this->movementRepo->firstIn($data['product_id']);

            $data['purchase_price']	= $first->purchase_price;
            $data['selling_price']	= $pending->selling_price_total;
            $data['quantity'] 		= ($quantity > $first->in_stock) ? $first->in_stock : $quantity;

            $movement				= $this->movementRepo->newMovement();
            $manager				= new InventoryMovementSRegManager($movement, $data);
            $manager->save();

            array_push($movements, $movement);

            $movement->sales()->attach($pending->sale_id, ['movement_in'=>$first->id]);

            if( $movement->product->p_description->have_series )
            {
                $movement->sales[0]->series_end = 0;
                $movement->sales[0]->save();
            }

            $first->in_stock 	= ( $first->in_stock > $data['quantity'] ) ? $first->in_stock - $quantity : 0 ;
            $first->save();

            $quantity -= $movement->quantity;
        }

        $this->pendingRepo->destroy($pending->id);

        return ( Request::ajax() ) ?
            Response::json($this->msg200 + [ 'data' => $movements ]) :
            Redirect::route('pas.index');
    }

	/**
	 * Display the specified resource.
	 * GET /movement/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$movement = $this->movementRepo->find($id);
		$this->notFoundUnless($movement);

		if ( Request::ajax() ) return Response::json($movement);

		return View::make('movement/show', compact('movement'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /movement/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$movement = $this->movementRepo->find($id);
		$this->notFoundUnless($movement);

		$status = ( count($movement->purchases) > 0 ) ? $movement->purchases[0]->status : $movement->sales[0]->status;

        if( count($movement->sales) > 0 )
        {
            if( $movement->sales[0]->movements_end )
            {
                return Redirect::back()->with('msg', 'No es posible eliminar el producto.');
            }
        }

        if( count($movement->purchases) )
        {
            if( !$movement->purchases[0]->progress_4 )
            {
                return Redirect::back()->with('message', 'No es posible eliminar el producto.');
            }
        }

		if ($status != 'Pendiente' AND $status != 'En proceso...')
		{
			return Redirect::back()->with('msg', 'No es posible eliminar el producto.');
		}

		if ( $movement->status == 'in' AND $movement->in_stock != $movement->quantity )
		{
			return ( Request::ajax() ) ?
				Response::json($this->msg304) :
                Redirect::back()->with('msg', "No es posible eliminar el producto " . $movement->product->barcode);
		}

		if ( $movement->status == 'out' AND $movement->product->type == 'Producto' )
		{
			$this->newMovementIn($movement);
		}

		$this->movementRepo->destroy($id);

		return ( Request::ajax() ) ?
			Response::json($this->msg200 + [ 'data' => $movement ]) :
            Redirect::back();
	}

    public function destroySimple($id)
    {
        $movement = $this->movementRepo->find($id);
        $this->notFoundUnless($movement);

        if( count($movement->sales) > 0 OR count($movement->purchases) > 0 )
        {
            return Redirect::route('movement.index')->with('message', 'No es posible eliminar este movimiento.');
        }

        if( $movement->status == 'in' AND $movement->quantity != $movement->in_stock )
        {
            return Redirect::route('movement.index')->with('message', 'No es posible eliminar este movimiento.');
        }

        foreach($movement->series_out as $series)
        {
            $series->status = 'Disponible';
            $series->save();
        }

        $movement->delete();

        return Redirect::route('movement.index')->with('message', 'El movimiento se elimino correctamente.');
    }



	public function newMovementIn($movement)
	{
		$movement_in			= $this->movementRepo->find($movement->sales[0]->pivot->movement_in);
		$movement_in->in_stock	+= $movement->quantity;

		$movement_in->save();

		foreach($movement->seriesOut as $series)
		{
			$series->status			= 'Disponible';
			$series->movement_out	= 0;
			$series->save();
		}
	}

	public function getPriceOffer($product)
	{
		$offer = $product->offer;

		if ( $offer == 0 )		return $product->price_1;
		if ( $offer == 1 ) 		return $product->price_1;
		elseif ( $offer == 2 )	return $product->price_2;
		elseif ( $offer == 3 )	return $product->price_3;
		elseif ( $offer == 4 )	return $product->price_4;
		elseif ( $offer == 5 )	return $product->price_5;
	}

}