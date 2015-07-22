<?php

use microchip\sale\SaleRepo;
use microchip\sale\SaleFormat;
use microchip\configuration\ConfigurationRepo;
use microchip\inventoryMovement\InventoryMovementRepo;
use microchip\orderProduct\OrderProductRepo;
use microchip\company\CompanyRepo;
use microchip\sale\SaleOrderUpdManager;
use microchip\inventoryMovement\InventoryMovementSRegManager;
use microchip\customer\CustomerRepo;

class OrderController extends \BaseController
{
    protected $saleRepo;
    protected $configRepo;
    protected $movementRepo;
    protected $customerRepo;
    protected $companyRepo;
    protected $orderProductRepo;

    protected $formatData;

    public function __construct(
        SaleRepo                $saleRepo,
        ConfigurationRepo       $configurationRepo,
        SaleFormat              $saleFormat,
        CompanyRepo             $companyRepo,
        InventoryMovementRepo   $inventoryMovementRepo,
        OrderProductRepo        $orderProductRepo,
        CustomerRepo            $customerRepo
    ) {
        $this->saleRepo         = $saleRepo;
        $this->configRepo       = $configurationRepo;
        $this->formatData       = $saleFormat;
        $this->companyRepo      = $companyRepo;
        $this->movementRepo     = $inventoryMovementRepo;
        $this->orderProductRepo = $orderProductRepo;
        $this->customerRepo     = $customerRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /order.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->saleRepo->getByClassification('Pedido', 'id', 'ASC', 'ajax', 'Cancelado');
        }

        $orders = $this->saleRepo->getByClassification('Pedido', 'id', 'DESC', '', 'Cancelado');

        return View::make('order/index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /order/create.
     *
     * @return Response
     */
    public function create()
    {
        $sale   = $this->saleRepo->newSale();
        $global = $this->configRepo->first();

        $sale->iva                = $global->iva;
        $sale->dollar           = $global->dollar;
        $sale->type                = 'Ticket';
        $sale->classification    = 'Pedido';
        $sale->status            = 'Pendiente';
        $sale->delivery_date    = date('Y-m-d');
        $sale->user_id            = Auth::user()->id;
        $sale->customer_id        = 1;
        $sale->separated        = 1;
        $sale->save();

        return Redirect::route('order.edit', [$sale->id]);
    }

    /**
     * Store a newly created resource in storage.
     * POST /order.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /order/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order  = $this->saleRepo->find($id);
        $this->notFoundUnless($order);

        if (Request::ajax()) {
            return Response::json($order);
        }

        return View::make('order/show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /order/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        /*
        if ($sale->status != 'Pendiente') {
            return Redirect::route('home.sale');
        }
        */

        return View::make('order/edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /order/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $order = $this->saleRepo->find($id);
        $this->notFoundUnless($order);

        $customer = $this->customerRepo->find(Input::get('customer_id'));
        if (!is_null($customer) AND !$customer->active) {
            return Redirect::back()->withInput()->with('msg', 'El cliente no esta activo.');
        }

        $data = Input::all();
        $data['customer_order'] = Input::get('customer_id');

        if ($order->folio == '') {
            $folio = $this->saleRepo->getFolio('Pedido');

            $data['folio_separated'] = str_pad($folio, 8, '0', STR_PAD_LEFT);
        }

        $manager = new SaleOrderUpdManager($order, $data);
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $order];

            return Response::json($response);
        }

        $this->formatData->formatData($order);

        return Redirect::route('order.print', [$order->folio, $order->id]);
    }

    public function orderPrint($folio, $id)
    {
        $order = $this->saleRepo->find($id);
        $this->notFoundUnless($order);

        $this->formatData->formatData($order);

        return View::make('order/print', compact('order'));
    }

    public function generatePrint($id)
    {
        $order    = $this->saleRepo->find($id);
        $this->notFoundUnless($order);

        $this->formatData->formatData($order);
        $company    = $this->companyRepo->find(1);

        $configuration = $this->configRepo->find(1);

        $pdf = PDF::loadView('order/layout_print', compact('order', 'company', 'configuration'))->setPaper('letter');

        return $pdf->stream();
    }

    public function generatePrintLarge($id)
    {
        $order    = $this->saleRepo->find($id);
        $this->notFoundUnless($order);

        $this->formatData->formatData($order);
        $company    = $this->companyRepo->find(1);

        $configuration = $this->configRepo->find(1);

        $pdf = PDF::loadView('order/layout_print_large', compact('order', 'company', 'configuration'))->setPaper('letter');

        return $pdf->stream();
    }

    public function search($type)
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            return $this->saleRepo->search($terms, $type, 'ajax');
        }

        $results = $this->saleRepo->search($terms, $type);

        return View::make('order/search', compact('results', 'terms'));
    }

    public function cancel($id)
    {
        $order = $this->saleRepo->find($id);
        $this->notFoundUnless($order);

        if ($order->status == 'Pendiente' or $order->status == 'Cancelado') {
            $message = 'No es posible cancelar este pedido.';

            if (Request::ajax()) {
                return Response::json($this->msg304 + ['message' => $message, 'data' => $order]);
            }

            return Redirect::back()->with('message', $message);
        }

        foreach ($order->pas as $pa) {
            $pa->status = 'Pendiente';
            $pa->productOrder = 1;
            $pa->productPrice = 0;
            $pa->save();
        }

        $this->undoMovements($order, false);

        foreach ($order->order_products as $product) {
            foreach($product->series as $series) {
                $series->status = 'Disponible';
                $series->save();
            }

            $this->orderProductRepo->destroy($product->id);
        }

        $this->restPoints($order);

        if ($order->user_total_pay == 0) {
            $order->repayment = 1;
        }

        $order->status = 'Cancelado';
        $order->save();

        $message = 'La venta se cancelo correctamente';

        return Redirect::back()->with('message', $message);
    }

    public function toSale($id)
    {
        $order  = $this->saleRepo->find($id);
        $this->notFoundUnless($order);

        $data      = Input::all();
        $movements = [];

        if (count($order->orderProducts) != $order->pas()->where('productOrder',1)->count() and $order->classification == 'Pedido') {
            return Redirect::back()->with('message', 'Aún hay productos pendientes en este pedido.');
        }

        foreach ($order->orderProducts as $orderProduct) {
            if ($orderProduct->getClassRowSeriesAttribute() == 'red') {
                return Redirect::back()->with('message', 'Aún falta registrar numeros de serie.');
            }
        }

        foreach ($order->orderProducts as $orderProduct) {
            $total    = $this->movementRepo->totalStock($orderProduct->product_id);
            $iva      = $order->iva;
            $quantity = $orderProduct->quantity;

            while ($quantity > 0) {
                if ($orderProduct->product->type == 'Producto') {
                    $first = $this->movementRepo->firstIn($orderProduct->product_id);

                    $data['purchase_price'] = $first->purchase_price;
                    $data['quantity']       = ($orderProduct->quantity > $first->in_stock) ? $first->in_stock : $orderProduct->quantity;
                    $in_id                  = $first->id;
                } else {
                    $data['purchase_price'] = 0;
                    $data['quantity']       = $quantity;
                    $in_id                  = 0;
                }

                $data['selling_price']  = $orderProduct->selling_price;
                $data['product_id']     = $orderProduct->product_id;
                $data['total_in_stock'] = $total;
                $data['iva']            = $iva;
                $data['movement_in_id'] = $in_id;

                $movement               = $this->movementRepo->newMovement();
                $manager                = new InventoryMovementSRegManager($movement, $data);
                $manager->save();

                array_push($movements, $movement);

                $movement->sales()->attach($order->id, ['movement_in' => $in_id]);

                if ($orderProduct->product->type == 'Producto') {
                    if ($orderProduct->product->p_description->have_series) {
                        foreach ($orderProduct->series as $series) {
                            $series->status = 'Vendido';
                            $series->movement_out   = $movement->id;
                            $series->save();
                        }
                    }

                    $first->in_stock = ($first->in_stock > $data['quantity']) ? $first->in_stock - $quantity : 0;
                    $first->save();
                }

                $quantity -= $movement->quantity;
            }
        }

        $order->classification  = 'Venta';
        $order->status          = 'Pendiente';
        $order->save();

        return (Request::ajax()) ?
            Response::json($this->msg200 + ['data' => $movements]) :
            Redirect::route('sale.edit', [$order->id]);
    }
}
