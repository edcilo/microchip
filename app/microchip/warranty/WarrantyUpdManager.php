<?php

namespace microchip\warranty;

use microchip\base\BaseManager;

class WarrantyUpdManager  extends BaseManager
{
    public function getRules()
    {
        return [
            'quantity'      => 'required|integer',
            'product_id'    => 'required|exists:products,id',
            'provider_id'   => 'required|exists:providers,id',
            'series_id'     => 'required|exists:series,id',
            'sale_id'       => 'required|exists:sales',
        ];
    }

    public function prepareData($data)
    {
        return $data;
    }
}
