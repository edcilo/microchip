<?php

namespace microchip\pay;

use microchip\base\BaseManager;

class PayRegisterOutManager extends BaseManager
{
    public function getRules()
    {
        return [
            'amount'            => 'required|numeric',
            'change_check'      => 'boolean',
            'concept_id'        => 'required|exists:payment_concepts,id',
            'description'       => 'max:255',
            'date'              => 'required|date',
            'user_id'           => 'required|exists:users,id',
            'user_receiving_id' => 'required|exists:users,id',
        ];
    }

    public function prepareData($data)
    {
        $data['amount'] *= -1;
        $data['method'] = 'Efectivo';
        $data['date'] = $data['date'] . ' ' . date('H:i:s');

        return $data;
    }
}
