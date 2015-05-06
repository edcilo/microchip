<?php

namespace microchip\providerBank;

use microchip\base\BaseEntity;

class ProviderBank extends BaseEntity
{
    protected $fillable = [
        'bank',
        'account',
        'plaza',
        'clabe',
        'provider_id',
    ];

    public function provider()
    {
        return $this->belongsTo('microchip\provider\Provider');
    }
}
