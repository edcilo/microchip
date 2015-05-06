<?php

namespace microchip\provider;

use microchip\base\BaseEntity;

class Provider extends BaseEntity
{
    protected $fillable = [
        'name',
        'rfc',
        'email',
        'number',
        'classification',
        'state',
        'city',
        'postcode',
        'address',
        'address_warranty',
        'days_credit',
        'credit_limit',
        'observations',
        'active',
        'slug',
    ];

    public function banks()
    {
        return $this->hasMany('microchip\providerBank\ProviderBank');
    }

    public function contacts()
    {
        return $this->hasMany('microchip\providerContact\ProviderContact');
    }

    public function phones()
    {
        return $this->hasMany('microchip\providerPhone\ProviderPhone');
    }

    public function purchases()
    {
        return $this->hasMany('microchip\purchase\Purchase');
    }
}
