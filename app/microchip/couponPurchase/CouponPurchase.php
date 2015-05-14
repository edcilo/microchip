<?php

namespace microchip\couponPurchase;

use microchip\base\BaseEntity;

class CouponPurchase extends BaseEntity {

	protected $fillable = [
        'folio',
        'value',
        'observations',
        'purchase_id',
        'provider_id',
        'warranty_id',
    ];

    public function getValueFAttribute()
    {
        return number_format($this->value, 2, '.', ',');
    }

    public function warranty()
    {
        return $this->belongsTo('microchip\warranty\Warranty');
    }

    public function provider()
    {
        return $this->belongsTo('microchip\provider\Provider');
    }

}