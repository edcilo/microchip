<?php

namespace microchip\pay;

use microchip\base\BaseManager;

class PayChangeRegisterManager extends BaseManager
{
    public function getRules()
    {
        return [
            'amount' => 'required|numeric',
            'description' => '',
        ];
    }

    public function prepareData($data)
    {
        $data['amount'] *= -1;
        $data['change_check'] = 0;
        $data['user_receiving_id'] = $this->entity->user_receiving_id;
        $data['date'] = $this->entity->date;

        return $data;
    }
}
