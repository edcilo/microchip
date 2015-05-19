<?php

namespace microchip\coupon;

use Carbon\Carbon;
use microchip\base\BaseEntity;

class Coupon extends BaseEntity
{
    protected $fillable = [
        'available',
        'folio',
        'value',
        'effective_days',
        'customer_id',
        'user_id',
        'warranty_id',
    ];

    public function getValueFAttribute()
    {
        return number_format($this->value, 2, '.', ',');
    }

    public function getLastDateAttribute()
    {
        $created_at = $this->created_at;

        if ($this->effective_days != 0) {
            return $created_at->addDays($this->effective_days);
        }

        return false;
    }

    public function getLapsedAttribute()
    {
        if (!$this->getLastDateAttribute()) {
            return false;
        }

        $first = $this->getLastDateAttribute();
        $second = Carbon::now();

        return $first->lte($second);
    }

    public function user()
    {
        return $this->belongsTo('microchip\user\User');
    }

    public function customer()
    {
        return $this->belongsTo('microchip\customer\Customer');
    }

    public function sale()
    {
        return $this->belongsTo('microchip\sale\Sale');
    }

    public function pay()
    {
        return $this->hasOne('microchip\pay\Pay');
    }

    public function warranty()
    {
        return $this->belongsTo('mmicrochip\warranty\Warranty');
    }
}
