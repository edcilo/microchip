<?php

namespace microchip\warranty;

use microchip\base\BaseManager;

class WarrantyRegManager extends BaseManager
{
    public function getRules()
    {
        $rules = [
            'description'   => 'required|max:562',
            'series_id'     => 'required|exists:series,id',
            'sale_id'       => 'exists:sales',
            'purchase_id'   => 'required|exists:purchases,id',
        ];

        return $rules;
    }

    public function prepareData($data)
    {
        return $data;
    }
}
