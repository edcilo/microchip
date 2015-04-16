<?php namespace microchip\warranty;

use microchip\base\BaseEntity;

class Warranty extends BaseEntity {
	protected $fillable = [
        'quantity',
        'product_id',
        'provider_id',
        'series_id',
        'sale_id'
    ];

    public function product()
    {
        return $this->belongsTo('microchip\product\Product');
    }

    public function provider()
    {
        return $this->belongsTo('microchip\provider\Provider');
    }

    public function series()
    {
        return $this->belongsTo('microchip\series\Series');
    }

    public function sale()
    {
        return $this->belongsTo('microchip\sale\Sale');
    }
}