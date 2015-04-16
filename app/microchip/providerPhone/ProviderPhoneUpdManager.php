<?php namespace microchip\providerPhone;

use microchip\base\BaseManager;

class ProviderPhoneUpdManager extends BaseManager {

    public function getRules()
    {
        return [
            'phone'         => 'required|numeric',
            'provider_id'   => 'required|exists:providers,id',
        ];
    }

}