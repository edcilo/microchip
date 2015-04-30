<?php namespace microchip\coupon;

class Coupon extends \Eloquent {

	protected $fillable = [
        'folio',
        'value',
        'effective_days',
        'customer_id',
        'user_id',
    ];

    public function customer()
    {
        return $this->belongsTo('microchip\customer\Customer');
    }

    public function user()
    {
        return $this->belongsTo('microchip\user\User');
    }
}