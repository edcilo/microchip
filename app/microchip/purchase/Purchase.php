<?php

namespace microchip\purchase;

use microchip\base\BaseEntity;

class Purchase extends BaseEntity
{
    protected $fillable = [
        'folio',
        'status',
        'date',
        'reception_date',
        'iva',
        'bill_scan',
        'progress_1',
        'progress_2',
        'progress_3',
        'progress_4',
        'provider_id',
        'user_id',
    ];

    public function getSubtotalFAttribute($f = '')
    {
        $total = 0;

        foreach ($this->movements as $movement) {
            if (!$movement->q_warranty) {
                $total += $movement->getTotalPurchaseWithoutIvaAttribute();
            }
        }

        return number_format($total, 2, '.', $f);
    }

    public function getTotalAttribute($f = '')
    {
        $total = 0;

        foreach ($this->movements as $movement) {
            if (!$movement->q_warranty) {
                $total += $movement->purchase_price * $movement->quantity * (($this->iva / 100) + 1);
            }
        }

        return number_format($total, 2, '.', $f);
    }

    public function getTotalPayAttribute($f = '')
    {
        $total = 0;
        $payments = $this->payments;

        if (count($payments)) {
            foreach ($payments as $payment) {
                $total += $payment->value;
            }
        }

        return number_format($total, 2, '.', $f);
    }

    public function getRestAttribute($f = '')
    {
        $total = $this->getTotalAttribute();
        $pay   = $this->getTotalPayAttribute();
        $rest  = $total - $pay;
        return number_format($rest, 2, '.', $f);
    }

    public function payments()
    {
        return $this->hasMany('microchip\purchasePayment\PurchasePayment');
    }

    public function provider()
    {
        return $this->belongsTo('microchip\provider\Provider');
    }

    public function user()
    {
        return $this->belongsTo('microchip\user\User');
    }

    public function movements()
    {
        return $this->belongsToMany('microchip\inventoryMovement\InventoryMovement');
    }

    public function warranties()
    {
        return $this->hasMany('microchip\warranty\Warranty');
    }

    public function coupons()
    {
        return $this->hasMany('microchip\couponPurchase\CouponPurchase');
    }
}
