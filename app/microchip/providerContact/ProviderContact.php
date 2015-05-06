<?php

namespace microchip\providerContact;

use microchip\base\BaseEntity;

class ProviderContact extends BaseEntity
{
    protected $fillable = [
        'name',
        'last_name',
        'job',
        'phone',
        'email',
        'provider_id',
    ];

    public function provider()
    {
        return $this->belongsTo('microchip\provider\Provider');
    }
}
