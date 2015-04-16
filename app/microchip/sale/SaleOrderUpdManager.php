<?php namespace microchip\sale;

use microchip\base\BaseManager;

class SaleOrderUpdManager extends BaseManager{

    public function getRules()
    {
        return [
            'customer_id'       => 'required|not_in:1,exists:customers,id',
            'advance'           => 'required|numeric',
            'delivery_date'     => 'required|date',
            'shipping_address'  => ''
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['status'] = 'Emitido';

        return $data;
    }

}