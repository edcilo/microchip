<?php

namespace microchip\warranty;

use microchip\base\BaseManager;

class WarrantyRegManager extends BaseManager
{
    public function getRules()
    {
        $rules = [
            'quantity'      => 'required|integer|min:1|max:'.$this->data['quantity_max'],
            'product_id'    => 'required|exists:products,id',
            'provider_id'   => 'required|exists:providers,id',
            //'series_id'     => 'exists:series,id',
            'sale_id'       => 'required|exists:sales,id',
        ];

        return $rules;
    }

    public function prepareData($data)
    {
        return $data;
    }
}
