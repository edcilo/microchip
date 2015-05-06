<?php

namespace microchip\sale;

use microchip\base\BaseManager;

class SalePriceUpdManager extends BaseManager
{
    public function getRules()
    {
        return [
            'customer_id'       => 'required|not_in:1,exists:customers,id',
            'description'       => '',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['status']     = 'Emitido';
        $data['advance']    = 0;

        return $data;
    }
}
