<?php

namespace microchip\support;

use microchip\base\BaseManager;

class SupportRegManager extends BaseManager
{
    public function getRules()
    {
        return [
            'barcode' => 'required|exists:products,barcode'
        ];
    }

    public function prepareData($data)
    {
        return $data;
    }
}