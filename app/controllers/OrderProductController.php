<?php

use microchip\orderProduct\OrderProductRepo;
use microchip\pendingMovement\PendingMovementRepo;
use microchip\series\SeriesRepo;
use microchip\user\UserRepo;

use microchip\orderProduct\OrderProductRegManager;
use microchip\orderProduct\OrderProductUpdManager;
use microchip\orderProduct\OrderProductPerUpdManager;

class OrderProductController extends \BaseController {

    protected $orderProductRepo;
    protected $pendingMovementRepo;
    protected $seriesRepo;
    protected $userRepo;

    public function __construct(
        OrderProductRepo    $orderProductRepo,
        PendingMovementRepo $pendingMovementRepo,
        SeriesRepo          $seriesRepo,
        UserRepo            $userRepo
    )
    {
        $this->orderProductRepo     = $orderProductRepo;
        $this->pendingMovementRepo  = $pendingMovementRepo;
        $this->seriesRepo           = $seriesRepo;
        $this->userRepo             = $userRepo;
    }

	/**
	 * Display a listing of the resource.
	 * GET /orderproduct
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /orderproduct/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /orderproduct
	 *
	 * @return Response
	 */
	public function store()
	{
        $message        = '';
        $pa             = $this->pendingMovementRepo->find(Input::get('pa_id'));
        $this->notFoundUnless($pa);

        if($pa->status != 'Surtido' AND $pa->sale->status != 'Cancelado')
        {
            $data           = Input::all() + ['selling_price'=>$pa->selling_price, 'pa_quantity'=>$pa->orders_rest, 'pending_movement_id'=>$pa->id, 'sale_id'=>$pa->sale_id];

            $c = 0;
            foreach($pa->orders as $order)
            {
                if($order->product_id == $data['product_id'])
                {
                    if($order->pa->orders_rest < $data['quantity'])
                    {
                        $message = 'La cantidad a surtir no es permitida.';
                        if(Request::ajax())
                            return Redirect::json($this->msg304 + ['data'=>$message]);
                        else
                            return Redirect::back()->with('message', $message);
                    }

                    $productOrder               = $order;
                    $productOrder->quantity    += $data['quantity'];
                    $productOrder->save();

                    $c++;
                }
            }

            if($c == 0)
            {
                $productOrder   = $this->orderProductRepo->newOrderProduct();
                $manager        = new OrderProductRegManager($productOrder, $data);
                $manager->save();
            }

            if($pa->orders_rest - $productOrder->quantity <= 0)
            {
                $pa->status     = 'Surtido';
                $pa->save();
            }
        }
        else
        {
            $message    = 'Este producto ya ha sido surtido';
            $response   = $this->msg304 + ['data' => $message];
        }

        if ( Request::ajax() )
            return Response::json($response);

        return Redirect::back()->with('message', $message);
	}

	/**
	 * Display the specified resource.
	 * GET /orderproduct/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /orderproduct/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /orderproduct/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /orderproduct/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$order  = $this->orderProductRepo->find($id);
        $this->notFoundUnless($order);

        if($order->order->classification == 'Venta')
        {
            $message = 'No es posible eliminar el producto asignado.';

            if ( Request::ajax() )
            {
                return Response::json($this->msg200 + ['data' => $message]);
            }

            return Redirect::back()->with('message', $message);
        }

        $data = Input::all();
        if($order->product->type == 'Producto')
        {
            if($order->product->p_description->have_series)
            {
                $quantity = count($data['ns']);

                foreach($data['ns'] as $ns)
                {
                    $series                 = $this->seriesRepo->find($ns);
                    $series->status         = 'Disponible';
                    $series->separated_id   = 0;
                    $series->save();
                }
            }
            else
            {
                $quantity = $data['quantity'];
            }
        }
        else
        {
            $quantity = $data['quantity'];
        }

        if($quantity <= 0 OR $quantity > $order->pa->orders_total)
        {
            $message = 'No es posible desapartar la cantidad indicada.';

            if ( Request::ajax() )
                return Response::json($this->msg304 + ['data' => $message]);

            return Redirect::back()->with('message', $message);
        }

        if($quantity == $order->pa->orders_total)
        {
            $this->orderProductRepo->destroy($id);
        }
        else
        {
            $order->quantity -= $quantity;
            $order->save();
        }

        $order->pa->status = 'Pendiente';
        $order->pa->save();

        if ( Request::ajax() )
        {
            $response = $this->msg200 + [ 'data' => $order ];

            return Response::json($response);
        }

        return Redirect::back();
	}

    public function support($id)
    {
        $order = $this->orderProductRepo->find($id);
        $this->notFoundUnless($id);

        return View::make('service/support', compact('order'));
    }

    public function permission($id)
    {
        $order = $this->orderProductRepo->find($id);
        $this->notFoundUnless($id);

        $data = [];

        $authentication = $this->getAuthentication(Input::all(), $data);

        if(!$authentication)
        {
            return Redirect::back()->with(['message' => 'Error en las credenciales de autenticación.']);
        }

        $manager = new OrderProductPerUpdManager($order, $data);
        $manager->save();

        return Redirect::route('service.show', [$order->order->id]);
    }

    public function permissionDown($id)
    {
        $order = $this->orderProductRepo->find($id);
        $this->notFoundUnless($id);

        $data = [];

        $authentication = $this->getAuthentication(Input::all(), $data);

        if(!$authentication OR $order->user_id != $data['user_id'] OR $order->admin_id != $data['admin_id'] OR $order->support_id != $data['support_id'])
        {
            return Redirect::back()->with(['message' => 'Error en las credenciales de autenticación.']);
        }

        $order->user_id = 0;
        $order->admin_id = 0;
        $order->support_id = 0;
        $order->save();

        return Redirect::route('service.show', [$order->order->id]);
    }

    public function getAuthentication($data, &$data_register)
    {
        $admin_auth = false;
        $support_auth = false;
        $data_register['user_id'] = Auth::user()->id;

        $admin = $this->userRepo->getUserByPassword($data['admin_pass']);
        $support = $this->userRepo->getUserByPassword($data['support_pass']);

        if( $admin )
        {
            $data_register['admin_id'] = $admin->id;
            $admin_auth = in_array(103, $admin->permissions_array);
        }

        if( $support )
        {
            $data_register['support_id'] = $support->id;
            $support_auth = in_array(103, $support->permissions_array);
        }

        return $admin_auth AND $support_auth;
    }

}