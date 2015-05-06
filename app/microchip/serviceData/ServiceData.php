<?php

namespace microchip\serviceData;

use microchip\base\BaseEntity;

class ServiceData extends BaseEntity
{
    protected $fillable = [
        'status',
        'equipment',
        'mark',
        'model',
        'series',
        'details',
        'observations',
        'internal',
        'warranty_id',
        'sale_id',
    ];

    public function sale()
    {
        return $this->belongsTo('microchip\sale\Sale');
    }

    public function warranty()
    {
        return $this->belongsTo('microchip\sale\Sale', 'warranty_id', 'id');
    }
}
