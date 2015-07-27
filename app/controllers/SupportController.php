<?php

use microchip\support\SupportRepo;
use microchip\product\ProductRepo;
use microchip\inventoryMovement\InventoryMovementRepo;
use microchip\user\UserRepo;

class SupportController extends \BaseController
{
    protected $supportRepo;
    protected $productRepo;
    protected $movementRepo;
    protected $userRepo;

    public function __construct(
        SupportRepo $supportRepo,
        ProductRepo $productRepo,
        InventoryMovementRepo $movementRepo,
        UserRepo $userRepo
    ) {
        $this->supportRepo = $supportRepo;
        $this->productRepo = $productRepo;
        $this->movementRepo = $movementRepo;
        $this->userRepo = $userRepo;
    }

	/**
	 * Display a listing of the resource.
	 * GET /support
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = $this->supportRepo->getAll();

		return View::make('support.index', compact('products'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /support/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('support.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /support
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = Request::only(['barcode', 'quantity', 'status', 'observations']);
        $rules = [
            'barcode' => 'required|exists:products,barcode',
            'quantity' => 'required|integer',
            'status' => 'required|in:Gasto,Uso,Prestamo|not_in:Devuelto',
            'observations' => ''
        ];

		$validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $product    = $this->productRepo->getByBarcode($data['barcode']);
        if ($product->type != 'Producto') {
            return Redirect::back()->withInput()->withErrors(['barcode' => 'No esta permitido registrar Servicios']);
        }

        $total      = $this->movementRepo->totalStock($product->id);
        if ($total == 0 OR $total < $data['quantity']) {
            return Redirect::back()->withInput()->withErrors(['quantity' => 'No hay existencia suficiente']);
        }

        $data['product_id'] = $product->id;

        $support = $this->supportRepo->newSupport();
        $support->fill($data);
        $support->save();

        $data['total_in_stock'] = $total;

        $quantity = $data['quantity'];
        while ($quantity > 0) {
            $first                  = $this->movementRepo->firstIn($product->id);
            $data['purchase_price'] = $first->purchase_price;
            $data['selling_price']  = $data['purchase_price'];
            $data['movement_in_id'] = $first->id;
            $data['quantity']       = ($quantity > $first->in_stock) ? $first->in_stock : $quantity;
            $data['description']    = 'En soporte';
            $data['status']         = 'out';

            $movement = $this->movementRepo->newMovement();
            $movement->fill($data);
            $movement->save();

            $support->movements()->attach($movement->id);

            $first->in_stock = ($first->in_stock > $data['quantity']) ? $first->in_stock - $quantity : 0;
            $first->save();

            $quantity -= $movement->quantity;
        }

		return Redirect::route('support.show', $support->id);
	}

	/**
	 * Display the specified resource.
	 * GET /support/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $product = $this->supportRepo->find($id);
        $this->notFoundUnless($product);

		return View::make('support.show', compact('product'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /support/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function seriesCreate($support_id, $movement_id)
    {
        $support = $this->supportRepo->find($support_id);
        $movement = $this->movementRepo->find($movement_id);

        $movement->series = $movement->seriesOut;

        return View::make('support.series_create', compact('movement', 'support'));
    }

    public function authorize($support_id)
    {
        $support = $this->supportRepo->find($support_id);
        $this->notFoundUnless($support);

        if ($support->authorized_by OR $support->given_by OR $support->received_by) {
            return Redirect::back()->with('error', 'Este producto ya fue autorizado.');
        }

        $data = Input::only(['given_by', 'received_by', 'authorized_by']);
        $rules = [
            'authorized_by' => 'required',
            'given_by' => 'required',
            'received_by' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $authorized = $this->userRepo->getUserByPassword($data['authorized_by']);
        $given = $this->userRepo->getUserByPassword($data['given_by']);
        $received = $this->userRepo->getUserByPassword($data['received_by']);

        if (!$authorized OR !$given OR !$received) {
            return Redirect::back()->with('error', 'Una de las contraseña es erronea');
        }

        $support->authorized_by = $authorized->id;
        $support->given_by = $given->id;
        $support->received_by = $received->id;
        $support->save();

        return Redirect::back()->with('error', 'El producto se autorizo correctamente.');
    }

}