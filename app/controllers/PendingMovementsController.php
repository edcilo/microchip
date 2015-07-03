<?php

use microchip\pendingMovement\PendingMovementRepo;
use microchip\sale\SaleRepo;
use microchip\inventoryMovement\InventoryMovementRepo;
use microchip\product\ProductRepo;
use microchip\configuration\ConfigurationRepo;
use microchip\pendingMovement\PendingMovementRegManager;

class PendingMovementsController extends \BaseController
{
    protected $paRepo;
    protected $saleRepo;
    protected $movementRepo;
    protected $productRepo;
    protected $configRepo;

    public function __construct(
        PendingMovementRepo     $pendingMovementRepo,
        SaleRepo                $saleRepo,
        InventoryMovementRepo   $inventoryMovementRepo,
        ProductRepo             $productRepo,
        ConfigurationRepo       $configurationRepo
    ) {
        $this->paRepo   = $pendingMovementRepo;
        $this->saleRepo = $saleRepo;
        $this->movementRepo = $inventoryMovementRepo;
        $this->productRepo  = $productRepo;
        $this->configRepo   = $configurationRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /pendingmovements.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->paRepo->getAll('all', 'barcode', 'ASC');
        }

        $pas = $this->paRepo->getAll('paginate', 'barcode', 'asc');

        foreach ($pas as $pa) {
            $pa->s_description = substr($pa->s_description, 0, 117).'...';
            $pa->sale->folio = str_pad($pa->sale->id, 8, '0', STR_PAD_LEFT);
        }

        return View::make('pa/index', compact('pas'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /pendingmovements/create.
     *
     * @return Response
     */
    public function create($id)
    {
        $sale   = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        return View::make('pa/create', compact('sale'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /pendingmovements.
     *
     * @return Response
     */
    public function store()
    {
        $pa         = $this->paRepo->newPA();
        $manager    = new PendingMovementRegManager($pa, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $pa];

            return Response::json($response);
        }

        if ($pa->sale->classification == 'Pedido') {
            return Redirect::route('order.edit', Input::get('sale_id'));
        } elseif ($pa->sale->classification == 'Cotización') {
            return Redirect::route('price.edit', $pa->sale->id);
        } elseif ($pa->sale->classification == 'Servicio') {
            $pa->productOrder = 0;
            $pa->save();

            if ($pa->sale->status == 'Pendiente') {
                return Redirect::route('service.edit', $pa->sale->id);
            } else {
                return Redirect::route('service.show', $pa->sale->id);
            }
        } else {
            return Redirect::back();
        }
    }

    public function orderStore()
    {
        $data = Input::all();

        $validator  = Validator::make(
            $data,
            [
                'barcode'    => 'required|exists:products,barcode',
                'sale_id'    => 'required|exists:sales,id',
            ]
        );

        if ($validator->fails()) {
            if (Request::ajax()) {
                return Response::json($this->msg304 + [$validator->messages()]);
            }

            return Redirect::back()->withInput()->withErrors($validator->messages());
        }

        $sale       = $this->saleRepo->find($data['sale_id']);

        $product    = $this->productRepo->getByBarcode($data['barcode']);
        $iva        = $sale->iva;

        $validator = Validator::make(
            $data,
            [
                'selling_price' => 'required|numeric|min:'.(number_format($product->price_5 * (($iva / 100) + 1), 2, '.', '')),
                'quantity'      => 'required|integer',
            ]
        );

        if ($validator->fails()) {
            if (Request::ajax()) {
                return Response::json($this->msg304 + [$validator->messages()]);
            }

            return Redirect::back()->withInput()->withErrors($validator->messages());
        }

        $pa = $this->paRepo->newPA();
        $pa->barcode        = $product->barcode;
        $pa->s_description  = $product->s_description;
        $pa->quantity       = Input::get('quantity');
        $pa->quantity_price = $pa->quantity;
        $pa->selling_price  = Input::get('selling_price');
        $pa->product_id     = $product->id;
        $pa->productOrder   = ($sale->classification == 'Pedido') ? 1 : 0;
        $pa->productPrice   = ($sale->classification == 'Cotización' or $sale->classification == 'Servicio') ? 1 : 0;
        $pa->sale_id        = Input::get('sale_id');
        $pa->save();

        if (Request::ajax()) {
            return Response::json($this->msg200 + ['data' => $pa]);
        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     * GET /pendingmovements/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pa = $this->paRepo->find($id);
        $this->notFoundUnless($pa);

        if (Request::ajax()) {
            return Response::json($pa);
        }

        return View::make('pa/show', compact('pa'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /pendingmovements/{id}/edit.
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
     * PUT /pendingmovements/{id}.
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
     * DELETE /pendingmovements/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pa = $this->paRepo->find($id);
        $this->notFoundUnless($pa);

        if ($pa->sale->separated and $pa->sale->price) {
            $pa->soft_delete = 1;
            $pa->save();
        } elseif ($pa->sale->service) {
            $pa->quantity       = $pa->quantity_price;
            $pa->productOrder   = 0;
            $pa->status         = 'Pendiente';
            $pa->save();

            if (isset($pa->orders[0])) {
                foreach ($pa->orders[0]->series as $series) {
                    $series->status         = 'Disponible';
                    $series->separated_id   = 0;
                    $series->save();
                }

                $pa->orders[0]->delete();
            } else {
                $this->paRepo->destroy($id);
            }
        } else {
            $this->paRepo->destroy($id);
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $pa];

            return Response::json($response);
        }

        return Redirect::back();
    }
}
