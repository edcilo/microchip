<?php

use microchip\warranty\WarrantyRepo;
use microchip\warranty\WarrantyRegManager;
use microchip\series\SeriesRepo;
use microchip\company\CompanyRepo;
use microchip\inventoryMovement\InventoryMovementRepo;
use microchip\product\ProductRepo;
use microchip\couponPurchase\CouponPurchaseRepo;

class WarrantyController extends \BaseController
{
    protected $warrantyRepo;
    protected $seriesRepo;
    protected $companyRepo;
    protected $movementRepo;
    protected $productRepo;
    protected $couponPurchaseRepo;

    public function __construct(
        WarrantyRepo            $warrantyRepo,
        SeriesRepo              $seriesRepo,
        CompanyRepo             $companyRepo,
        InventoryMovementRepo   $inventoryMovementRepo,
        ProductRepo             $productRepo,
        CouponPurchaseRepo      $couponPurchaseRepo
    ) {
        $this->warrantyRepo = $warrantyRepo;
        $this->seriesRepo   = $seriesRepo;
        $this->companyRepo  = $companyRepo;
        $this->movementRepo = $inventoryMovementRepo;
        $this->productRepo  = $productRepo;
        $this->couponPurchaseRepo = $couponPurchaseRepo;
    }

    public function getWarranty($id)
    {
        $warranty = $this->warrantyRepo->find($id);
        $this->notFoundUnless($warranty);

        return $warranty;
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

        $warranties = $this->warrantyRepo->getAll('paginate', 'created_at', 'desc');

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
        return View::make('warranty.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /warranty.
     *
     * @return Response
     */
    public function store()
    {
        $ns = Input::get('series');

        $series = $this->seriesRepo->findBySeriesForWarranty($ns);

        if (is_null($series)) {
            return Redirect::back()->withInput()->withErrors(['series' => 'El producto no se encuentra registrado o ya esta en garantía.']);
        }

        if ($series->status == 'Garantía') {
            return Redirect::back()->withInput()->withErrors(['series' => 'El producto ya se encuentra en garantía']);
        }

        if (count($series->movement->purchases) == 0) {
            return Redirect::back()->withInput()->withErrors(['series' => 'Este producto no puede ser enviado a garantía.']);
        }

        $former_status  = $series->status;

        $data = [
            'former_status' => $former_status,
            'description'   => Input::get('description'),
            'series_id'     => $series->id,
            'purchase_id'   => $series->movement->purchases[0]->id,
            'created_by'    => Auth::user()->id
        ];

        if ($series->movement_out) {
            $data['sale_id'] = $series->movementOut->sales[0]->id;
            $data['service_id'] = Input::get('service_id');
        }

        $warranty = $this->warrantyRepo->newWarranty();
        $manager = new WarrantyRegManager($warranty, $data);
        $manager->save();

        $series->status = 'Garantía';
        $series->save();

        $message = ['success' => 'Se registro correctamente la garantía.'];

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $warranty];

            return Response::json($response);
        }

        return Redirect::back()->with($message);
    }

    public function show($id)
    {
        $warranty = $this->getWarranty($id);

        return View::make('warranty.show', compact('warranty'));
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
        $warranty = $this->getWarranty($id);

        if ($warranty->status == 'Terminado') {
            if (Request::ajax()) {
                $response = $this->msg304 + ['data' => ['folio' => $warranty->folio]];

                return Response::json($response);
            }

            return Redirect::back()->with('message', 'No es posible eliminar una garantía con estado terminado.');
        }

        $this->changeMovementStatus($warranty->series, $warranty->former_status);
        $this->removeMovementOut($warranty);

        $this->warrantyRepo->destroy($id);

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $warranty];

            return Response::json($response);
        }

        return Redirect::route('warranty.index');
    }

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            $results = $this->warrantyRepo->search($terms, 'ajax');

            return Response::json($results);
        } else {
            $results = $this->warrantyRepo->search($terms);

            return View::make('warranty/search', compact('results', 'terms'));
        }
    }


    public function send($id)
    {
        $warranty = $this->getWarranty($id);

        $movement = $this->movementRepo->newMovement();
        $movement->product_id = $warranty->series->product->id;
        $movement->quantity = 1;
        $movement->status = 'out';
        $movement->purchase_price = $warranty->series->movement->purchase_price;
        $movement->description = 'Producto enviado a garantía';
        $movement->movement_in_id = $warranty->series->movement->id;
        $movement->save();

        $warranty->status = 'Enviado';
        $warranty->movement_out = $movement->id;
        $warranty->sent_at = date('Y-m-d H:i:s');
        $warranty->sent_by = Auth::user()->id;
        $warranty->series->movement->in_stock -= 1;
        //$warranty->series->movement_out = $movement->id;
        $warranty->push();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $warranty];

            return Response::json($response);
        }

        return Redirect::back()->with('message', 'Se cambio el status de la garantía ' . $warranty->folio . ' a enviado.');
    }

    public function generatePrint($id)
    {
        $warranty = $this->getWarranty($id);
        $company  = $this->companyRepo->find(1);

        $pdf = PDF::loadView('warranty/layout_print', compact('warranty', 'company'))->setPaper('letter');

        return $pdf->stream();
    }

    public function storeSolution($id)
    {
        $warranty = $this->getWarranty($id);

        if ($warranty->status != 'Enviado') {
            return Redirect::back()->with('message', 'No es posible modificar a la garantía ' . $warranty->folio);
        }

        $solution = Input::get('solution');

        switch ($solution) {
            case 1:
            case 4:
                $this->changeMovementStatus($warranty->series, $warranty->former_status);
                $this->removeMovementOut($warranty);
                break;
            case 2:
                $product = $this->productRepo->getByBarcode(Input::get('barcode'));
                $unique = $this->seriesRepo->unique(Input::get('ns'));
                $errors = [];

                if (is_null($product)) {
                    $errors['barcode'] = 'El producto no es valido.';
                } elseif (is_null($product->p_description)) {
                    $errors['barcode'] = 'El producto no es valido.';
                } elseif (!$product->p_description->have_series) {
                    $errors['barcode'] = 'El producto no es valido.';
                }

                if (!$unique) {
                    $errors['ns'] = 'EL número de serie ya se encuentra registrado.';
                }

                if (count($errors)) {
                    return Redirect::back()->withInput()->withErrors($errors);
                }

                $movement = $this->movementRepo->newMovement();
                $movement->q_warranty     = 1;
                $movement->product_id     = $product->id;
                $movement->in_stock       = 1;
                $movement->quantity       = 1;
                $movement->status         = 'in';
                $movement->purchase_price = $warranty->series->movement->purchase_price;
                $movement->description    = 'Entrada por garantía';
                $movement->save();

                $movement->purchases()->attach($warranty->purchase_id);

                $series = $this->seriesRepo->newSeries();
                $series->ns = strtoupper(Input::get('ns'));
                $series->product_id = $product->id;
                $series->inventory_movement_id = $movement->id;
                $series->status = $warranty->former_status;
                $series->save();

                if ($warranty->sale_id) {
                    $movement_out = $this->movementRepo->newMovement();
                    $movement_out->q_warranty     = 1;
                    $movement_out->product_id     = $product->id;
                    $movement_out->quantity       = 1;
                    $movement_out->status         = 'out';
                    $movement_out->purchase_price = $warranty->series->movement->purchase_price;
                    $movement_out->description    = 'Salida por garantía';
                    $movement_out->movement_in_id = $movement->id;
                    $movement_out->save();

                    $movement_out->sales()->attach([$warranty->sale_id => ['movement_in' => $movement->id]]);

                    $series->movement_out = $movement_out->id;
                    $series->status = 'Vendido';
                    $series->save();
                }

                $warranty->movement_in = $movement->id;
                $warranty->series->status = 'Baja';
                break;
            case 3:
                // todo si la garantia proviene de una venta generar el vale de compra
                $data = Input::all();
                $rules = [
                    'folio_c'           => 'required|unique:coupon_purchases,folio',
                    'value'             => 'required|numeric',
                    'observations_c'    => 'required|max:255'
                ];

                $validator = Validator::make($data, $rules);

                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }

                $coupon                 = $this->couponPurchaseRepo->newCoupon();
                $coupon->folio          = $data['folio_c'];
                $coupon->value          = $data['value'];
                $coupon->observations   = $data['observations_c'];
                $coupon->purchase_id    = $warranty->purchase->id;
                $coupon->provider_id    = $warranty->purchase->provider_id;
                $coupon->warranty_id    = $warranty->id;
                $coupon->save();
                break;
            default:
                return Redirect::back()->withInput()->withErrors(['solution' => 'La solución propuesta no es admisible.']);
        }

        $warranty->observations = Input::get('observations');
        $warranty->status = 'Terminado';
        $warranty->solution = $solution;
        $warranty->push();

        return Redirect::back()->with('message', 'El registro del termino del proceso de garantía se ha registrado satisfactoriamente.');
    }

    public function removeMovementOut($warranty)
    {
        if ($warranty->movementOut) {
            $movement_in = $this->movementRepo->find($warranty->movementOut->movement_in_id);
            $movement_in->in_stock += 1;
            $movement_in->save();

            $warranty->movementOut->delete();
        }
    }

    public function changeMovementStatus($series, $status)
    {
        $series->status = $status;
        $series->save();
    }
}
