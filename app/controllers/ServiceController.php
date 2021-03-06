<?php

use microchip\sale\SaleRepo;
use microchip\configuration\ConfigurationRepo;
use microchip\company\CompanyRepo;
use microchip\orderProduct\OrderProductRepo;
use microchip\sale\SaleServiceUpdManager;
use microchip\customer\CustomerRepo;
use microchip\comment\CommentRepo;
use microchip\comment\CommentRegManager;

class ServiceController extends \BaseController
{
    protected $saleRepo;
    protected $configRepo;
    protected $companyRepo;
    protected $orderProductRepo;
    protected $customerRepo;
    protected $commentRepo;

    public function __construct(
        SaleRepo            $saleRepo,
        ConfigurationRepo   $configurationRepo,
        CompanyRepo         $companyRepo,
        OrderProductRepo    $orderProductRepo,
        CustomerRepo        $customerRepo,
        CommentRepo         $commentRepo
    ) {
        $this->saleRepo         = $saleRepo;
        $this->configRepo       = $configurationRepo;
        $this->companyRepo      = $companyRepo;
        $this->orderProductRepo = $orderProductRepo;
        $this->customerRepo     = $customerRepo;
        $this->commentRepo      = $commentRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /service.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->saleRepo->getByClassification('Servicio', 'id', 'ASC', 'ajax', 'Cancelado');
        }

        $status = (is_null(Input::get('status'))) ? '' : Input::get('status');

        $services = $this->saleRepo->getServiceOrder($status);

        return View::make('service/index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /service/create.
     *
     * @return Response
     */
    public function create()
    {
        $sale = $this->saleRepo->newSale();
        $global = $this->configRepo->first();

        $sale->iva = $global->iva;
        $sale->dollar = $global->dollar;
        $sale->type = 'Ticket';
        $sale->classification = 'Servicio';
        $sale->status = 'Pendiente';
        $sale->delivery_date = date('Y-m-d');
        $sale->user_id = Auth::user()->id;
        $sale->customer_id = 1;
        $sale->service = 1;
        $sale->save();

        return Redirect::route('service.edit', [$sale->id]);
    }

    /**
     * Display the specified resource.
     * GET /service/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        if (Request::ajax()) {
            return Response::json($sale);
        }

        return View::make('service/show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /service/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        if ($sale->status != 'Pendiente') {
            return Redirect::route('home.sale');
        }

        return View::make('service/edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /service/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $service = $this->saleRepo->find($id);
        $this->notFoundUnless($service);

        $customer = $this->customerRepo->find(Input::get('customer_id'));
        if (is_null($customer)) {
            return Redirect::back()->withInput()->withErrors(['customer_id' => 'El cliente no esta registrado']);
        }

        if (!is_null($customer) AND !$customer->active) {
            return Redirect::back()->withInput()->with('msg', 'El cliente no esta activo.');
        }

        if (Input::get('customer_id') == 1) {
            return Redirect::back()->withInput()->withErrors([
                'customer_id' => 'No se puede registrar un servicio como venta de mostrador; debe de dar de alta o seleccionar un cliente'
            ]);
        }

        $data = Input::all();
        $data['customer_order'] = Input::get('customer_id');

        if ($service->folio == '') {
            $folio = $this->saleRepo->getFolio('Servicio');

            $data['folio_service'] = str_pad($folio, 8, '0', STR_PAD_LEFT);
        }

        $manager = new SaleServiceUpdManager($service, $data);
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $service];

            return Response::json($response);
        }

        return Redirect::route('service.print', [$service->folio, $service->id]);
    }

    public function servicePrint($folio, $id)
    {
        $sale = $this->saleRepo->find($id);
        $this->notFoundUnless($sale);

        return View::make('service/print', compact('sale'));
    }

    public function generatePrint($id)
    {
        $service = $this->saleRepo->find($id);
        $this->notFoundUnless($service);

        $company = $this->companyRepo->find(1);

        $configuration = $this->configRepo->find(1);

        $pdf = PDF::loadView('service/layout_print', compact('service', 'company', 'configuration'))->setPaper('letter');

        return $pdf->stream();
    }

    public function generatePrintLarge($id)
    {
        $service = $this->saleRepo->find($id);
        $this->notFoundUnless($service);

        $company = $this->companyRepo->find(1);

        $configuration = $this->configRepo->find(1);

        $pdf = PDF::loadView('service/layout_print_large', compact('service', 'company', 'configuration'))->setPaper('letter');

        return $pdf->stream();
    }

    public function setAuthorization($id)
    {
        $service = $this->saleRepo->find($id);
        $this->notFoundUnless($service);

        $service->data->status = 'Autorización';
        $service->data->save();

        if (Request::ajax()) {
            return Response::json($this->msg200 + ['data' => $service]);
        }

        return Redirect::back();
    }

    public function setContinue($id)
    {
        $service = $this->saleRepo->find($id);
        $this->notFoundUnless($service);

        $service->data->status = 'Proceso';
        $service->data->save();

        if (Request::ajax()) {
            return Response::json($this->msg200 + ['data' => $service]);
        }

        return Redirect::back();
    }

    public function finish($id)
    {
        $service = $this->saleRepo->find($id);
        $this->notFoundUnless($service);

        if ($service->status == 'Cancelado' OR $service->trash) {
            $message = 'No es posible finalizar el servicio.';

            if (Request::ajax()) {
                return Response::json($this->msg304 + ['message' => $message, 'data' => $service]);
            }

            return Redirect::back()->with('message', $message);
        }

        $service->data->status = 'Terminado';
        $service->data->save();

        if (Request::ajax()) {
            return Response::json($this->msg200);
        }

        return Redirect::back()->with('message', 'El servicio se ha marcado como terminado.');
    }

    public function restart($id)
    {
        $service = $this->saleRepo->find($id);
        $this->notFoundUnless($service);

        if ($service->status == 'Cancelado' OR $service->trash) {
            $message = 'No es posible regresar el servicio a proceso.';

            if (Request::ajax()) {
                return Response::json($this->msg304 + ['message' => $message, 'data' => $service]);
            }

            return Redirect::back()->with('message', $message);
        }

        $service->data->status = 'Pendiente';
        $service->data->save();

        return Redirect::back()->with('message', 'El servicio se ha marcado como pendiente.');
    }

    public function cancel($id)
    {
        $service = $this->saleRepo->find($id);
        $this->notFoundUnless($service);

        if ($service->status == 'Pendiente' or $service->status == 'Cancelado' or $service->trash) {
            $message = 'No es posible cancelar este servicio.';

            if (Request::ajax()) {
                return Response::json($this->msg304 + ['message' => $message, 'data' => $service]);
            }

            return Redirect::back()->with('message', $message);
        }

        foreach ($service->pas as $pa) {
            $pa->status = 'Pendiente';
            $pa->save();
        }

        foreach ($service->order_products as $product) {
            foreach($product->series as $series) {
                $series->status = 'Disponible';
                $series->save();
            }

            $this->orderProductRepo->destroy($product->id);
        }

        $this->undoMovements($service, false);

        if ($service->user_total_pay == 0) {
            $service->repayment = 1;
        }

        $service->status = 'Cancelado';
        $service->data->status = 'Cancelado';
        $service->push();

        $message = 'El servicio se cancelo correctamente';

        return Redirect::back()->with('message', $message);
    }

    public function restore($id)
    {
        $service = $this->saleRepo->find($id);
        $this->notFoundUnless($service);

        if ($service->trash) {
            $data = Input::all();
            $data['sale_id'] = $service->id;
            $data['user_id'] = Auth::user()->id;

            $comment = $this->commentRepo->newComment();
            $manager = new CommentRegManager($comment, $data);
            $manager->save();

            $service->trash = 0;
            $service->save();

            $message = 'El servicio se recupero correctamente.';
        } else {
            $message = 'El servicio no esta descartado.';
        }

        return Redirect::route('service.show', $service->id)->with('message', $message);
    }

    // todo revisar esta accion
    public function sendTrash($id)
    {
        $service = $this->saleRepo->find($id);
        $this->notFoundUnless($service);

        if (!$service->trash) {
            $data = Input::all();
            $data['sale_id'] = $service->id;
            $data['user_id'] = Auth::user()->id;

            $comment = $this->commentRepo->newComment();
            $manager = new CommentRegManager($comment, $data);
            $manager->save();

            foreach ($service->pas as $pa) {
                $pa->status = 'Pendiente';
                $pa->save();
            }

            foreach ($service->order_products as $product) {
                foreach($product->series as $series) {
                    $series->status = 'Disponible';
                    $series->save();
                }

                $this->orderProductRepo->destroy($product->id);
            }

            $this->undoMovements($service, false);

            if ($service->user_total_pay == 0) {
                $service->repayment = 1;
            }

            $service->trash = 1;
            $service->save();

            $message = 'El servicio se descarto correctamente.';
        } else {
            $message = 'El servicio ya habia sido descartado.';
        }

        return Redirect::route('service.index')->with('message', $message);
    }

    public function trash()
    {
        $services = $this->saleRepo->getServiceTrash();

        return View::make('service/trash', compact('services'));
    }
}
