<?php namespace microchip\sale;

use microchip\base\BaseManager;

class SalePRegManager extends BaseManager{

    public function getRules()
    {
        $rules = [
            'barcode'   => 'required|exists:products,barcode'
        ];

        return $rules;
    }

    public function prepareData($data)
    {
        return $data;
    }

}