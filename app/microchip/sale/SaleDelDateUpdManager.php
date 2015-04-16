<?php namespace microchip\sale;

use microchip\base\BaseManager;

class SaleDelDateUpdManager extends BaseManager {

    public function getRules()
    {
        return [
            'delivery_time' => ['required','regex:/^(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$/'],
            'delivery_date' => 'required|date'
        ];
    }

    public function prepareData($data)
    {
        return $data;
    }

}