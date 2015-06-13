<?php

use microchip\serviceData\ServiceDataRepo;
use microchip\sale\SaleRepo;
use microchip\serviceData\ServiceDataRegManager;

class ServiceDataController extends \BaseController
{
    protected $serviceData;
    protected $saleRepo;

    public function __construct(
        ServiceDataRepo $serviceDataRepo,
        SaleRepo        $saleRepo
    ) {
        $this->serviceData  = $serviceDataRepo;
        $this->saleRepo     = $saleRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /servicedata.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /servicedata/create.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /servicedata.
     *
     * @return Response
     */
    public function store($sale_id)
    {
        $data = Input::all() + ['sale_id' => $sale_id];

        $sale = $this->saleRepo->getDocument('Venta', $data['folio_sale']);
        if (is_null($sale)) {
            return Redirect::back()->withInput()->withErrors(['folio_sale' => 'El folio del documento no existe']);
        }

        $data['warranty_id'] = $sale->id;

        $serviceData = $this->serviceData->newServiceData();
        $manager = new ServiceDataRegManager($serviceData, $data);
        $manager->save();

        if (Request::ajax()) {
            return Response::json($this->msg200 + ['data' => $serviceData]);
        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     * GET /servicedata/{id}.
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
     * GET /servicedata/{id}/edit.
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
     * PUT /servicedata/{id}.
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
     * DELETE /servicedata/{id}.
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
