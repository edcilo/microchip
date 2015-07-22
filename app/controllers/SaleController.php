<?php

use microchip\sale\SaleRepo;
use microchip\sale\SaleFormat;
use microchip\configuration\ConfigurationRepo;
use microchip\inventoryMovement\InventoryMovementRepo;
use microchip\customer\CustomerRepo;
use microchip\company\CompanyRepo;
use microchip\sale\SaleUpdManager;
use microchip\sale\SaleTotalUpdManager;
use microchip\sale\SaleDelDateUpdManager;
use microchip\helpers\NumberToLetter;

class SaleController extends \BaseController
{
    protected $saleRepo;
    protected $configRepo;
    protected $movementRepo;
    protected $customerRepo;
    protected $companyRepo;

    protected $formatData;
    protected $type_list    = ['Ticket' => 'Ticket', 'Factura' => 'Factura'];

    public function __construct(
        SaleRepo                $saleRepo,
        ConfigurationRepo        $configurationRepo,
        InventoryMovementRepo    $inventoryMovementRepo,
        SaleFormat                $saleFormat,
        CustomerRepo            $customerRepo,
        CompanyRepo                $companyRepo
    ) {
        $this->saleRepo        = $saleRepo;
        $this->configRepo    = $configurationRepo;
        $this->movementRepo    = $inventoryMovementRepo;
        $this->formatData    = $saleFormat;
        $this->customerRepo    = $customerRepo;
        $this->companyRepo    = $companyRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /sale.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->saleRepo->getByClassification('Venta', 'id', 'ASC', 'ajax');
        }

        $sales = $this->saleRepo->getByClassification('Venta', 'updated_at', 'DESC');

        return View::make('sale/index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /sale/create.
     *
     * @return Response
     */
    public function create()
    {
        // todo validar que el producto no este en papelera
        $global = $this->configRepo->first();
        $sale   = $this->saleRepo->newSale();

        $sale->iva              = $global->iva;
        $sale->dollar           = $global->dollar;
        $sale->type             = 'Ticket';
        $sale->classification   = 'Venta';
        $sale->status           = 'Pendiente';
        $sale->user_id          = Auth::user()->id;
        $sale->customer_id      = 1;
        $sale->save();

        return Redirect::route('sale.edit', [$sale->id]);
    }

    /**
     * Display the specified resource.
     * GET /sale/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        return View::make('sale/show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /sale/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        if ($sale->status == 'Cancelado') {
            $message = 'No es posible modificar una venta cancelada.';

            if (Request::ajax()) {
                $response = $this->msg304 + ['message' => $message, 'data' => $sale];

                return Response::json($response);
            }

            return Redirect::back()->with('message', $message);
        }

        $sale->status = 'Pendiente';
        $sale->save();

        $type_list    = $this->type_list;

        return View::make('sale/edit', compact('sale', 'type_list'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /sale/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        if ($sale->status == 'Cancelado') {
            $message = 'No es posible modificar una venta cancelada.';

            if (Request::ajax()) {
                $response = $this->msg304 + ['message' => $message, 'data' => $sale];

                return Response::json($response);
            }

            return Redirect::back()->with('message', $message);
        }

        $valid = $this->validateCustomer(Input::get('customer_id'), Input::get('type'));

        if ($valid[0]) {
            $folio = $this->saleRepo->getFolio('Venta');

            $data = Input::all() + ['folio' => str_pad($folio, 8, '0', STR_PAD_LEFT), 'sale' => 1];

            $manager = new SaleUpdManager($sale, $data);
            $manager->save();
        } else {
            if (Request::ajax()) {
                return Response::json($this->msg304 + ['data' => $valid['msg']]);
            }

            return Redirect::back()->withInput()->with('msg', $valid['msg']);
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $sale];

            return Response::json($response);
        }

        return Redirect::route('sale.print', [$sale->folio, $sale->id]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /sale/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        if ($sale->status != 'Pendiente') {
            $message = 'No es posible eliminar una venta concluida.';

            if (Request::ajax()) {
                $response = $this->msg304 + ['message' => $message,  'data' => $sale];

                return Response::json($response);
            }

            return Redirect::back()->with('message', $message);
        }

        $this->undoMovements($sale);

        $sale->delete();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $sale];

            return Response::json($response);
        }

        return Redirect::route('home.sale');
    }

    public function salePrint($folio, $id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        return View::make('sale/print', compact('sale'));
    }

    public function adjustPrice($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        $manager = new SaleTotalUpdManager($sale, Input::all());
        $manager->save();

        return Redirect::back();
    }

    public function generatePrint($id)
    {
        $sale    = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        $company = $this->companyRepo->find(1);

        $this->getNewPrice($sale);

        $configuration = $this->configRepo->find(1);

        $no2letter          = new NumberToLetter();
        $sale->total_text   = strtoupper($no2letter->ValorEnLetras($sale->getTotalAttribute(), 'pesos'));

        $pdf = PDF::loadView('sale/layout_print', compact('sale', 'company', 'percentage', 'configuration'))->setPaper('letter');

        return $pdf->stream();
    }

    public function generatePrintLarge($id)
    {
        $sale    = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        $company    = $this->companyRepo->find(1);

        $this->getNewPrice($sale);

        $configuration = $this->configRepo->find(1);

        $no2letter          = new NumberToLetter();
        $sale->total_text   = strtoupper($no2letter->ValorEnLetras($sale->getTotalAttribute(), 'pesos'));

        $pdf = PDF::loadView('sale/layout_print_large', compact('sale', 'company', 'percentage', 'configuration'))->setPaper('letter');

        return $pdf->stream();
    }

    public function stopRegisterMovements($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        $sale->movements_end    = 1;
        $sale->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $sale];

            return Response::json($response);
        }

        return Redirect::back();
    }

    public function startRegisterMovements($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        $sale->movements_end    = 0;
        $sale->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $sale];

            return Response::json($response);
        }

        return Redirect::back();
    }

    public function getNewPrice(&$sale)
    {
        if ($sale->new_price > 0) {
            $percentage    = $sale->new_price / $sale->getTotalAttribute();

            $sale->subtotal    = 0;
            $sale->total    = 0;
            foreach ($sale->movements as $movement) {
                $movement->selling_price_w_i_p = number_format($movement->getSellingPriceWithoutIvaAttribute() * $percentage, 2, '.', '');
                $movement->total_price_w_i_p   = number_format($movement->getTotalWithoutIvaAttribute() * $percentage, 2, '.', '');

                $sale->subtotal_p              += $movement->total_price_w_i_p;

                $movement->selling_price_w_i_p  = number_format($movement->selling_price_w_i_p, 2);
                $movement->total_price_w_i_p    = number_format($movement->total_price_w_i_p, 2);
            }
            $sale->total_p      = number_format($sale->subtotal_p * ($sale->iva / 100 + 1), 2);
            $sale->subtotal_p   = number_format($sale->subtotal_p, 2);
        }
    }

    public function validateCustomer($customer_id, $type)
    {
        $customer = $this->customerRepo->find($customer_id);
        $result = [true];

        if (is_null($customer)) {
            $result[0]        = false;
            $result['msg']    = 'El cliente no esta registrado.';
        } elseif (!$customer->active) {
            $result[0]        = false;
            $result['msg']    = 'El cliente no esta activo.';
        } elseif ($type == 'Factura') { // corregir
            if ($customer->rfc == '') {
                $result[0]        = false;
                $result['msg']    = 'El cliente no cuenta con un R.F.C.';
            }
            if ($customer->email == '') {
                $result[0]        = false;
                $result['msg']    = 'El cliente no tiene un correo electrónico';
            }
        } else {
            $result[0]     = true;
            $result['msg'] = 'El cliente es valido';
        }

        return $result;
    }

    public function editDeliveryDate($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        $manager = new SaleDelDateUpdManager($sale, Input::all());
        $manager->save();

        if (Request::ajax()) {
            return Response::json($this->msg200 + ['data' => $sale]);
        }

        return Redirect::back()->with('message', 'La fecha de entrega se modificó exitosamente.');
    }

    public function cancel($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        if ($sale->status == 'Pendiente' or $sale->status == 'Cancelado') {
            $message = 'No es posible cancelar esta venta.';

            if (Request::ajax()) {
                return Response::json($this->msg304 + ['message' => $message, 'data' => $sale]);
            }

            return Redirect::back()->with('message', $message);
        }

        $delete = $sale->sale AND ($sale->separated OR $sale->service);
        $status_series = $delete ? 'Apartado' : 'Disponible';
        $this->undoMovements($sale, $delete, $status_series);

        $this->restPoints($sale);

        if ($sale->user_total_pay == 0) {
            $sale->repayment = 1;
        }

        if ($sale->separated OR $sale->service) {
            $sale->classification = $sale->separated ? 'Pedido' : 'Servicio';
            $sale->sale = 0;
            $sale->save();

            $route = $sale->separated ? 'order.show' : 'service.show';
            
            return Redirect::route($route, $sale->id);
        }

        $sale->status = 'Cancelado';
        $sale->save();

        $message = 'La venta se cancelo correctamente';

        return Redirect::back()->with('message', $message);
    }

    public function cancellations()
    {
        $sales = $this->saleRepo->getCancellations();

        if (Request::ajax()) {
            return Response::json($this->msg200 + ['data' => $sales]);
        }

        return View::make('sale.cancellations', compact('sales'));
    }

    public function search($type)
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            return $this->saleRepo->search($terms, $type, 'ajax');
        }

        $results = $this->saleRepo->search($terms, $type);

        return View::make('sale/search', compact('results', 'terms'));
    }
}
