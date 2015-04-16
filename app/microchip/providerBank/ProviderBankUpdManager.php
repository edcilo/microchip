<?php namespace microchip\providerBank;

use microchip\base\BaseManager;

class ProviderBankUpdManager extends BaseManager {

    public function getRules()
    {
        return $rules = [
            'bank'          => 'required',
            'account'       => 'required|numeric|digits:11|unique:provider_banks,account,' . $this->entity->id,
            'plaza'         => '',
            'clabe'         => 'numeric|digits:18',
            'provider_id'   => 'required|exists:providers,id'
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        return $data;
    }

}