<?php

namespace microchip\customerReferral;

use microchip\base\BaseManager;

class CustomerReferralRegManager extends BaseManager
{
    public function getRules()
    {
        return $rules = [
            'customer_id'  => 'required|exists:customers,id',
            'referred_id'  => 'required|exists:customers,id',
            'observations' => '',
            'expiration'   => 'integer',
        ];
    }
}
