<?php

namespace microchip\purchasePayment;

use microchip\base\BaseManager;
use microchip\couponPurchase\CouponPurchaseRepo;

class PurchasePaymentRegManager extends BaseManager
{
    public function getRules()
    {
        $rules = [
            'value'              => 'required|numeric',
            'purchase_id'        => 'required|integer|exists:purchases,id',
            'type'               => 'required|max:255',
            'cheque_id'          => 'required_if:type,Cheque|integer',
            'method'             => 'required|in:Contado,Crédito',
            'payment_date'       => 'required|date',
            'status'             => 'required|in:Pagado,Pendiente',
            'coupon_purchase_id' => 'required_if:type,Nota de crédito|integer'
        ];

        if (!empty($this->data['cheque_id'])) {
            $rules['cheque_id'] .= '|exists:cheques,id';
        }

        if (!empty($this->data['coupon_purchase_id'])) {
            $rules['coupon_purchase_id'] .= '|exists:coupon_purchases,id';
        }

        return $rules;
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        if ($data['type'] != 'Cheque') {
            $data['cheque_id']  = 0;
        }

        return $data;
    }
}
