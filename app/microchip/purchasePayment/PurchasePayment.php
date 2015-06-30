<?php

namespace microchip\purchasePayment;

use Carbon\Carbon;
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
        'description',
    ];

    public function getPaymentDateFAttribute()
    {
        $date = Carbon::createFromFormat('Y-m-d', $this->payment_date);
        return $date->format('d-m-Y');
    }

    public function bill()
    {
        return $this->belongsTo('microchip\purchase\Purchase', 'purchase_id');
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
