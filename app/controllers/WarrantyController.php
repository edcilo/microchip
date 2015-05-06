<?php

use microchip\warranty\WarrantyRepo;
use microchip\inventoryMovement\InventoryMovementRepo;
use microchip\warranty\WarrantyRegManager;

class WarrantyController extends \BaseController
{
    protected $warrantyRepo;
    protected $movementRepo;

    public function __construct(
        WarrantyRepo            $warrantyRepo,
        InventoryMovementRepo   $inventoryMovementRepo
    ) {
        $this->warrantyRepo = $warrantyRepo;
        $this->movementRepo = $inventoryMovementRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /warranty.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->warrantyRepo->getAll('all', 'created_at', 'ASC');
        }

        $warranties = $this->warrantyRepo->getAll('paginate', 'created_at', 'asc');

        return View::make('warranty/index', compact('warranties'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /warranty/create.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /warranty.
     *
     * @return Response
     */
    public function store($movement_id)
    {
        $movement = $this->movementRepo->find($movement_id);
        $this->notFoundUnless($movement);

        /*
         * 'quantity'      => 'required|integer',
            'product_id'    => 'required|exists:products,id',
            'provider_id'   => 'required|exists:providers,id',
            'series_id'     => 'required|exists:series,id',
            'sale_id'       => 'required|exists:sales',
         */
        $data = Input::all() + [
                'product_id' => $movement->product->id,
                'provider_id' => $movement->movementIn->purchases[0]->provider->id, // que hacer cuando el movimiento de entrada no sea por compra?
                'sale_id' => $movement->sales[0]->id,
                'quantity_max' => $movement->quantity,
            ];

        $warranty = $this->warrantyRepo->newWarranty();
        $manager = new WarrantyRegManager($warranty, $data);
        $manager->save();

        $message = ['success' => 'Se registro correctamente la garantía.'];

        return Redirect::back()->with($message);
    }

    /**
     * Display the specified resource.
     * GET /warranty/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /warranty/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /warranty/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /warranty/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
