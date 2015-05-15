<?php

namespace microchip\purchasePayment;

use microchip\base\BaseEntity;

class PurchasePayment extends BaseEntity
{
    protected $fillable = [
        'value',
        'purchase_id',
        'cheque_id',
        'coupon_purchase_id',
        'method',
        'type',
        'payment_date',
        'status',
    ];

    public function bill()
    {
        return $this->belongsTo('microchip\purchase\Purchase');
    }

    public function cheque()
    {
        return $this->belongsTo('microchip\cheque\Cheque');
    }

    public function coupon()
    {
        return $this->belongsTo('microchip\couponPurchase\CouponPurchase', 'coupon_purchase_id');
    }
}
