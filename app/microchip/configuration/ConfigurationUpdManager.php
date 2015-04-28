<?php namespace microchip\configuration;

use microchip\base\BaseManager;

class ConfigurationUpdManager extends BaseManager {

    public function getRules()
    {
        return [
            'iva'                   => 'required|numeric',
            'dollar'                => 'required|numeric',
            'coupon_effective_days' => 'required|integer',
            'coupon_terms_use'      => 'max:255'
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        return $data;
    }

}