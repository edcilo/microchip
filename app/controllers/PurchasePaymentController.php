<?php

use microchip\purchasePayment\PurchasePaymentRepo;
use microchip\purchase\PurchaseRepo;
use microchip\purchasePayment\PurchasePaymentRegManager;
use microchip\couponPurchase\CouponPurchaseRepo;

class PurchasePaymentController extends \BaseController
{
    protected $paymentRepo;
    protected $purchaseRepo;
    protected $couponRepo;

    public function __construct(
        PurchasePaymentRepo $purchasePaymentRepo,
        PurchaseRepo        $purchaseRepo,
        CouponPurchaseRepo  $couponPurchaseRepo
    ) {
        $this->paymentRepo   = $purchasePaymentRepo;
        $this->purchaseRepo  = $purchaseRepo;
        $this->couponRepo    = $couponPurchaseRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /purchasepayment.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /purchasepayment/create.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /purchasepayment.
     *
     * @return Response
     */
    public function store()
    {
        $data     = \Input::all();
        $purchase = $this->purchaseRepo->find($data['purchase_id']);

        if ($purchase->status == 'Pagado') {
            return Redirect::back()->with('message', "La venta $purchase->folio ya esta pagada.");
        }

        $data += [
            'status' => 'Pagado',
            'value'  => $purchase->getRestAttribute()
        ];

        if ($data['type'] == 'Nota de crédito') {
            $coupon = $this->couponRepo->getByFolio($data['folio']);
            $validator = Validator::make($data, ['folio' => 'required|exists:coupon_purchases,folio']);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            if (!$coupon->available) {
                return Redirect::back()->withInput()->withErrors(['folio' => 'La nota de crédito ya fue utilizada.']);
            }

            $data['coupon_purchase_id'] = $coupon->id;
            $data['value'] = $coupon->value;
            $coupon->available = 0;
            $coupon->save();
        }

        $payment = $this->paymentRepo->newPayment();
        $manager = new PurchasePaymentRegManager($payment, $data);
        $manager->save();

        $purchase = $this->purchaseRepo->find($payment->purchase_id);
        if ($purchase->rest <= 0 ) {
            $purchase->status     = 'Pagado';
            $purchase->progress_1 = 1;
            $purchase->save();
        }

        return Redirect::route('purchase.show', [$purchase->folio, $purchase->id]);
    }

    /**
     * Display the specified resource.
     * GET /purchasepayment/{id}.
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
     * GET /purchasepayment/{id}/edit.
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
     * PUT /purchasepayment/{id}.
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
     * DELETE /purchasepayment/{id}.
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
