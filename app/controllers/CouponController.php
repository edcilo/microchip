<?php

use microchip\coupon\CouponRepo;
use microchip\company\CompanyRepo;
use microchip\helpers\NumberToLetter;
use microchip\configuration\ConfigurationRepo;
use microchip\sale\SaleRepo;
use microchip\customer\CustomerRepo;
use microchip\warranty\WarrantyRepo;

class CouponController extends \BaseController
{
    protected $couponRepo;
    protected $companyRepo;
    protected $confRepo;
    protected $saleRepo;
    protected $customerRepo;
    protected $warrantyRepo;

    public function __construct(
        CouponRepo          $couponRepo,
        CompanyRepo         $companyRepo,
        ConfigurationRepo   $configurationRepo,
        SaleRepo            $saleRepo,
        CustomerRepo        $customerRepo,
        WarrantyRepo        $warrantyRepo
    ) {
        $this->couponRepo   = $couponRepo;
        $this->companyRepo  = $companyRepo;
        $this->confRepo     = $configurationRepo;
        $this->saleRepo     = $saleRepo;
        $this->customerRepo = $customerRepo;
        $this->warrantyRepo = $warrantyRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /coupon.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->couponRepo->getAll('all', 'folio', 'DESC');
        }

        $coupons = $this->couponRepo->getAll('paginate', 'folio', 'DESC');

        return View::make('coupon/index', compact('coupons'));
    }

    public function store($sale_id)
    {
        $sale = $this->saleRepo->find($sale_id);
        $this->notFoundUnless($sale);

        $message   = 'No se pudo registrar la devolución.';
        $data      = Input::all();
        $rules     = [
            'customer_id' => 'required|exists:customers,id',
            'value'       => 'required|numeric',
            'type'        => 'required|in:coupon,card',
            'warranty_id' => 'required|exists:warranties,id'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $warranty = $this->warrantyRepo->find($data['warranty_id']);
        if (is_null($warranty->coupon)) {
            return Redirect::back()->withInput()->withErrors(['warranty' => 'La nota de crédito no existe']);
        } elseif ($warranty->coupon->coupon_customer) {
            return Redirect::back()->withInput()->withErrors(['warranty' => 'La nota de crédito ya fue otorgada a un cliente']);
        }

        if ($data['type'] == 'card') {
            $customer = $this->customerRepo->find($data['customer_id']);
            $customer->points += $data['value'];
            $customer->save();

            $message = "El rembolso de $ ". $data['value'] ." se agrego al monedero del cliente correctamente.";
        } elseif ($data['type'] == 'coupon') {
            $config = $this->confRepo->find(1);

            $coupon = $this->couponRepo->newCoupon();
            $coupon->value          = $data['value'];
            $coupon->effective_days = $config->coupon_effective_days;
            $coupon->customer_id    = $data['customer_id'];
            $coupon->sale_id        = $sale->id;
            $coupon->user_id        = Auth::user()->id;
            $coupon->warranty_id    = $data['warranty_id'];
            $coupon->save();

            $coupon->folio          = str_pad($coupon->id, 8, '0', STR_PAD_LEFT);
            $coupon->save();

            $message = "El vale por $ ". $data['value'] ." se registro correctamente.";
        }

        $warranty->coupon->coupon_customer = 1;
        $warranty->push();

        return Redirect::back()->with(['message' => $message]);
    }

    /**
     * Display the specified resource.
     * GET /coupon/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($folio, $id)
    {
        $coupon = $this->couponRepo->find($id);
        $this->notFoundUnless($coupon);

        if (Request::ajax()) {
            return Response::json($coupon);
        }

        return View::make('coupon.show', compact('coupon'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /coupon/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coupon = $this->couponRepo->find($id);
        $this->notFoundUnless($coupon);

        $this->couponRepo->destroy($id);

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $coupon];

            return Response::json($response);
        }

        return Redirect::route('coupon.index');
    }

    public function generatePrint($id)
    {
        $coupon = $this->couponRepo->find($id);
        $this->notFoundUnless($coupon);

        $company    = $this->companyRepo->find(1);

        $no2letter          = new NumberToLetter();
        $coupon->value_text = strtoupper($no2letter->ValorEnLetras($coupon->value, 'pesos'));
        $coupon->coupon_terms_use = $this->confRepo->find(1)->coupon_terms_use;

        $pdf = PDF::loadView('coupon/layout_print', compact('company', 'coupon'))->setPaper('letter');

        return $pdf->stream();
    }

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            $results = $this->couponRepo->search($terms, 'ajax');

            return Response::json($results);
        }

        $results = $this->couponRepo->search($terms);

        return View::make('coupon/search', compact('results', 'terms'));
    }

    public function get()
    {
        $data = $this->msg404;
        $folio = Input::get('folio');

        $coupon = $this->couponRepo->getByFolio($folio);

        if (!is_null($coupon)) {
            $data = $this->msg200 + $coupon->toArray();
        }

        return Response::json($data);
    }
}
