<?php namespace microchip\customerContact;

use microchip\base\BaseManager;

class CustomerContactRegManager extends BaseManager {

    public function getRules()
    {
        return $rules = [
            'customer_id' => 'required|integer|exists:customers,id',
            'contact_id'  => 'required|integer|exists:customers,id',
        ];
    }

    public function prepareData($data)
    {
        return $data;
    }

}