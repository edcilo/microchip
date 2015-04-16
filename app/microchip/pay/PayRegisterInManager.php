<?php namespace microchip\pay;

use microchip\base\BaseManager;

class PayRegisterInManager extends BaseManager {

    public function getRules()
    {
        return [
            'user_id'       => 'required|exists:users,id',
            'amount'        => 'required|numeric',
            'description'   => 'required',
            'date'          => 'required|date',
        ];
    }

    public function prepareData($data)
    {
        return $data;
    }

}