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
            'purchase_id'   => 'required|exists:purchases,id',
        ];

        if (isset($this->data['sale_id'])) {
            $rules['sale_id'] = 'required|exists:sales,id';
            $rules['service_id'] = 'required|exists:sales,id';
        }

        return $rules;
    }

    public function prepareData($data)
    {
        return $data;
    }
}
