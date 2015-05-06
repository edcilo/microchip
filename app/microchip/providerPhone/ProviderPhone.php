<?php

namespace microchip\providerPhone;

use microchip\base\BaseEntity;

class ProviderPhone extends BaseEntity
{
    protected $fillable = [
        'phone',
        'provider_id',
    ];

    public function provider()
    {
        return $this->belongsTo('microchip\provider\Provider');
    }
}
