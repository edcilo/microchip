<?php

use microchip\purchasePayment\PurchasePaymentRepo;
use microchip\purchase\PurchaseRepo;
use microchip\purchasePayment\PurchasePaymentRegManager;
use microchip\couponPurchase\CouponPurchaseRepo;
use microchip\cheque\ChequeRepo;

class PurchasePaymentController extends \BaseController
{
    protected $paymentRepo;
    protected $purchaseRepo;
    protected $couponRepo;
    protected $chequeRepo;

    public function __construct(
        PurchasePaymentRepo $purchasePaymentRepo,
        PurchaseRepo        $purchaseRepo,
        CouponPurchaseRepo  $couponPurchaseRepo,
        ChequeRepo          $chequeRepo
    ) {
        $this->paymentRepo   = $purchasePaymentRepo;
        $this->purchaseRepo  = $purchaseRepo;
        $this->couponRepo    = $couponPurchaseRepo;
        $this->chequeRepo    = $chequeRepo;
    }

    public function delete($payment_id)
    {
        $payment = $this->paymentRepo->find($payment_id);
        $this->notFoundUnless($payment);

        $payment->bill->status = 'En proceso...';
        $payment->bill->save();

        $payment->delete();

        return Redirect::back()->with('error', 'El pago fue eliminado.');
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
        $this->notFoundUnless($purchase);

        if ($purchase->status == 'Pagado') {
            return Redirect::back()->with('message', "La venta $purchase->folio ya esta pagada.");
        }

        $validator = Validator::make($data, [
            'type'               => 'required|in:Efectivo,Cheque,Transferencia,Nota de crédito,Otro',
            'cheque_id'          => 'required_if:type,Cheque|integer',
            'method'             => 'required|in:Contado,Crédito',
            'payment_date'       => 'required|date',
            'folio'              => 'required_if:type,Nota de crédito',
            'description'        => 'required_if:type,Transferencia',
            'type_other'         => 'required_if:type,Otro',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $data += [
            'status' => 'Pagado',
            'value'  => $purchase->getRestAttribute()
        ];

        if ($data['type'] == 'Nota de crédito') {
            $validator = Validator::make($data, ['folio' => 'required|exists:coupon_purchases,folio']);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }

            $coupon = $this->couponRepo->getByFolio($data['folio']);

            if (!$coupon->available) {
                return Redirect::back()->withErrors(['folio' => 'La nota de crédito ya fue utilizada.']);
            }

            $data['coupon_purchase_id'] = $coupon->id;
            $data['value'] = $coupon->value;
            $coupon->available = 0;
            $coupon->save();
        }

        if ($data['type'] == 'Cheque') {
            $validator = Validator::make($data, ['cheque_id' => 'required|exists:cheques,id']);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }

            $cheque = $this->chequeRepo->find($data['cheque_id']);
            if ($purchase->getRestAttribute() != $cheque->amount) {
                return Redirect::back()->withErrors(['cheque_id' => 'El monto del cheque no es igual al valor total restante de la compra.']);
            }
        }

        if ($data['type'] == 'Otro') {
            $data['type'] = $data['type_other'];
        }

        $payment = $this->paymentRepo->newPayment();
        $manager = new PurchasePaymentRegManager($payment, $data);
        $manager->save();

        $purchase = $this->purchaseRepo->find($data['purchase_id']);
        if ($purchase->rest <= 0 ) {
            $purchase->status     = 'Pagado';
            $purchase->progress_1 = 1;
            $purchase->save();
        }

        return Redirect::route('purchase.show', [$purchase->folio, $purchase->id]);
    }
}
