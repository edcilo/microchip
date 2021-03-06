<?php

use microchip\series\SeriesRepo;
use microchip\product\ProductRepo;
use microchip\inventoryMovement\InventoryMovementRepo;
use microchip\purchase\PurchaseRepo;
use microchip\sale\SaleRepo;
use microchip\orderProduct\OrderProductRepo;
use microchip\series\SeriesRegManager;
use microchip\configuration\ConfigurationRepo;

class SeriesController extends \BaseController
{
    protected $seriesRepo;
    protected $productRepo;
    protected $movementRepo;
    protected $purchaseRepo;
    protected $saleRepo;
    protected $orderProductRepo;
    protected $confRepo;

    public function __construct(
        SeriesRepo              $seriesRepo,
        ProductRepo             $productRepo,
        InventoryMovementRepo   $inventoryMovementRepo,
        PurchaseRepo            $purchaseRepo,
        SaleRepo                $saleRepo,
        OrderProductRepo        $orderProductRepo,
        ConfigurationRepo       $configurationRepo
    ) {
        $this->seriesRepo       = $seriesRepo;
        $this->productRepo      = $productRepo;
        $this->movementRepo     = $inventoryMovementRepo;
        $this->purchaseRepo     = $purchaseRepo;
        $this->saleRepo         = $saleRepo;
        $this->orderProductRepo = $orderProductRepo;
        $this->confRepo         = $configurationRepo;
    }

    /**
     * Show the form for creating a new resource.
     * GET /series/create/{movement_id}/{product_id}.
     *
     * @param int $movement_id
     * @param int $product_id
     *
     * @return Response
     */
    public function createPurchase($movement_id, $product_id)
    {
        $movement    = $this->movementRepo->find($movement_id);
        $product    = $this->productRepo->find($product_id);
        $purchase    = $movement->purchases->first();

        return View::make('series/createPurchase', compact('movement', 'product', 'purchase'));
    }

    public function createSale($movement_id)
    {
        $movement         = $this->movementRepo->find($movement_id);
        $sale             = $movement->sales->first();

        $movement->series = $movement->seriesOut;

        return View::make('series/createSale', compact('movement', 'sale'));
    }

    public function createSeparate($order_id)
    {
        $order  = $this->orderProductRepo->find($order_id);
        $this->notFoundUnless($order);

        return View::make('series/createSeparate', compact('order'));
    }

    public function createPrice($product_id)
    {
        $price  = $this->orderProductRepo->find($product_id);
        $this->notFoundUnless($price);

        return View::make('series/createPrice', compact('price'));
    }

    public function create($movement_id)
    {
        $movement = $this->movementRepo->find($movement_id);
        $movement->series = ($movement->status == 'in') ? $movement->series : $movement->seriesOut;

        return View::make('series/create', compact('movement'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /series.
     *
     * @return Response
     */
    public function store()
    {
        $movement = $this->movementRepo->find(Input::get('inventory_movement_id'));
        $this->notFoundUnless($movement);

        $validator = null;
        $collection = [];
        foreach (Input::get('ns') as $ns) {
            $data = [
                'ns' => $ns, 'product_id' => $movement->product->id, 'inventory_movement_id' => $movement->id,
            ];
            $data['status'] = ($movement->status == 'in') ? 'Disponible' : 'Vendido';

            $rules = [
                'ns'                    => 'required|',
                'product_id'            => 'required|exists:products,id',
                'inventory_movement_id' => 'required|exists:inventory_movements,id',
            ];
            $rules['ns'] .= ($movement->status == 'in') ? 'unique:series,ns' : 'exists:series,ns';

            $validator = Validator::make($data, $rules);

            if (!$validator->fails()) {
                if ($movement->status == 'in') {
                    $series     = $this->seriesRepo->newSeries();
                    $manager    = new SeriesRegManager($series, $data);
                    $manager->save();
                } else {
                    $series     = $this->seriesRepo->findBySeries($data['ns'], 'Disponible', $movement->product->id);

                    if ($series) {
                        $series->status = 'Vendido';
                        $series->movement_out = $movement->id;
                        $series->save();
                    }
                }

                array_push($collection, $series);
            }
        }

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $collection];

            return Response::json($response);
        }

        return Redirect::back();
    }

    public function storePurchase()
    {
        $collection  = [];
        $purchase_id = Input::get('purchase_id');
        $validator = null;

        if (is_null(Input::get('ns'))) {
            return Redirect::back()->withInput()->withErrors(['ns' => 'El campo Número de serie es obligatorio.']);
        }

        foreach (Input::get('ns') as $ns) {
            $data = Input::only('product_id', 'inventory_movement_id', 'purchase_id');
            $data += [
                'ns'        => $ns,
                'status'    => 'Disponible',
            ];

            $validator = Validator::make($data, [
                'ns'                    => 'required|unique:series,ns',
                'product_id'            => 'required|exists:products,id',
                'inventory_movement_id' => 'required|exists:inventory_movements,id',
                'purchase_id'           => 'required|exists:purchases,id',
            ]);

            if (!$validator->fails()) {
                $series  = $this->seriesRepo->newSeries();
                $manager = new SeriesRegManager($series, $data);
                $manager->save();

                array_push($collection, $series);
            }
        }

        $purchase = $this->purchaseRepo->find($purchase_id);
        $this->seriesEnd($purchase, 'purchase');

        if (count($validator->messages()) > 0) {
            if (Request::ajax()) {
                return $this->msg304 + $validator->getMessageBag()->toArray();
            }

            return Redirect::back()->withErrors($validator);
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $collection];

            return Response::json($response);
        }

        return Redirect::back();
    }

    public function storeSale()
    {
        $data        = Input::all();
        $movement    = $this->movementRepo->find($data['inventory_movement_id']);
        $this->notFoundUnless($movement);

        $collection    = [];
        foreach ($data['ns'] as $ns) {
            $data  = Input::only('inventory_movement_id');
            $data += ['ns' => $ns];

            $validator = Validator::make($data, [
                'ns'                    => 'required|exists:series,ns',
                'inventory_movement_id' => 'required|exists:inventory_movements,id',
            ]);

            if (!$validator->fails()) {
                $series = $this->seriesRepo->findBySeries($data['ns'], 'Disponible', $movement->product->id);

                if (!is_null($series)) {
                    $series->status = 'Vendido';
                    $series->movement_out = $movement->id;
                    $series->save();
                } else {
                    return Redirect::back()->withErrors(['ns' => "El número de serie ".$data['ns']." no esta disponible"]);
                }

                array_push($collection, $series);
            }
        }

        $this->seriesEnd($movement->sales[0], 'sale');

        if (count($validator->messages()) > 0) {
            return Redirect::back()->withErrors($validator);
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $collection];

            return Response::json($response);
        }

        return Redirect::back();
    }

    public function storeSeparate()
    {
        $data = Input::all();

        $orderProduct = $this->orderProductRepo->find($data['order_product_id']);
        $this->notFoundUnless($orderProduct);

        $collection    = [];
        foreach ($data['ns'] as $ns) {
            $data['ns'] = $ns;

            $validator = Validator::make(
                $data,
                [
                    'ns'               => 'required|exists:series,ns',
                    'order_product_id' => 'required|exists:order_products,id',
                ]
            );

            if (!$validator->fails()) {
                $series = $this->seriesRepo->findBySeries($data['ns'], 'Disponible', $orderProduct->product->id);

                if ($series) {
                    $series->status = 'Apartado';
                    $series->separated_id = $orderProduct->id;
                    $series->save();
                }

                array_push($collection, $series);
            }
        }

        if (count($validator->messages()) > 0) {
            return Redirect::back()->withErrors($validator);
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $collection];

            return Response::json($response);
        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     * GET /series/{ns}/{id}.
     *
     * @param string $ns
     * @param int    $id
     *
     * @return Response
     */
    public function show($ns, $id)
    {
        $series = $this->seriesRepo->find($id);
        $this->notFoundUnless($series);

        if (Request::ajax()) {
            return Response::json($series);
        }

        return View::make('series/show', compact('series'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /series/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $series = $this->seriesRepo->find($id);
        $this->notFoundUnless($series);
        $msg = '';

        if ($series->status == 'Disponible') {
            $this->seriesRepo->destroy($id);
            if (count($series->movement->purchases)) {
                $this->seriesEnd($series->movement->purchases[0], 'purchase');
            }
        } else {
            $msg = "No es posible eliminar el número de serie $series->ns.";
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $series];

            return Response::json($response);
        }

        return Redirect::back()->with('message', $msg);
    }

    public function printSeries($id)
    {
        $series = $this->seriesRepo->find($id);
        $this->notFoundUnless($series);

        $configuration = $this->confRepo->find(1);

        $pdf = PDF::loadView('series.layout_print', compact('series', 'configuration'))->setPaper([
            0, 0,
            $configuration->with_real_paper_barcode,
            $configuration->height_real_paper_barcode
        ]);

        return $pdf->stream();
    }

    public function purchasePrint($movement_id)
    {
        $movement    = $this->movementRepo->find($movement_id);
        $this->notFoundUnless($movement);

        $series = $movement->series;
        $configuration = $this->confRepo->find(1);

        if (count($series) == 0) {
            if (Request::ajax()) {
                return Response::json($this->msg304);
            }

            return Redirect::back();
        }

        if (count($series) == 1) {
            $series = $series[0];
        }

        $pdf = PDF::loadView('series.layout_print', compact('series', 'configuration'))->setPaper([
            0, 0,
            $configuration->with_real_paper_barcode,
            $configuration->height_real_paper_barcode
        ]);

        return $pdf->stream();
    }
}
