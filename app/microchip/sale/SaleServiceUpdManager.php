<?php namespace microchip\sale;

use microchip\base\BaseManager;

class SaleServiceUpdManager extends BaseManager {

    public function getRules()
    {
        return [
            'customer_id'       => 'required|not_in:1,exists:customers,id',
            'description'       => '',
            'delivery_date'     => 'required|date',
            'delivery_time'     => ['required','regex:/^(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$/'],
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['status']     = 'Emitido';
        //$data['advance']    = 0;

        return $data;
    }

}