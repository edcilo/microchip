<?php

namespace microchip\pay;

use Carbon\Carbon;
use microchip\base\BaseEntity;

class Pay extends BaseEntity
{
    protected $fillable = [
        'amount',
        'change',
        'pending',
        'concept_id',
        'description',
        'method',
        'reference',
        'entity',
        'change_check',
        'user_receiving_id',
        'date',
        'sale_id',
        'user_id',
    ];

    public function getClassRowAttribute()
    {
        return ($this->amount < 0) ? 'red' : '';
    }

    public function getDateFAttribute()
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->date);

        return $date->format('d-m-Y h:ia');
    }

    public function sale()
    {
        return $this->belongsTo('microchip\sale\Sale');
    }

    public function user()
    {
        return $this->belongsTo('microchip\user\User');
    }

    public function userReceiving()
    {
        return $this->belongsTo('microchip\user\User', 'user_receiving_id', 'id');
    }

    public function coupon()
    {
        return $this->belongsTo('microchip\coupon\Coupon');
    }

    public function concept()
    {
        return $this->belongsTo('microchip\paymentConcept\PaymentConcept', 'concept_id');
    }
}
