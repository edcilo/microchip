<?php

namespace microchip\providerBank;

use microchip\base\BaseManager;

class ProviderBankRegManager extends BaseManager
{
    public function getRules()
    {
        return [
            'bank'          => 'required',
            'account'       => 'required|numeric|digits:11|unique:provider_banks,account',
            'plaza'         => '',
            'clabe'         => 'numeric|digits:18',
            'provider_id'   => 'required|exists:providers,id',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        return $data;
    }
}
