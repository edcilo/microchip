<?php namespace microchip\providerPhone;

use microchip\base\BaseManager;

class ProviderPhoneRegManager extends BaseManager {

    public function getRules()
    {
        return [
            'phone'         => 'required|numeric',
            'provider_id'   => 'required|exists:providers,id',
        ];
    }

}