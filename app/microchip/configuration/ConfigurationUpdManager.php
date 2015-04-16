<?php namespace microchip\configuration;

use microchip\base\BaseManager;

class ConfigurationUpdManager extends BaseManager {

    public function getRules()
    {
        return [
            'iva'       => 'required|numeric',
            'dollar'    => 'required|numeric',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        return $data;
    }

}