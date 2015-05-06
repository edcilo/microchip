<?php

namespace microchip\orderProduct;

use microchip\base\BaseManager;

class OrderProductPerUpdManager extends BaseManager
{
    public function getRules()
    {
        return [
            'user_id'       => 'required|exists:users,id',
            'admin_id'      => 'required|exists:users,id',
            'support_id'    => 'required|exists:users,id',
        ];
    }

    public function prepareData($data)
    {
        return $data;
    }
}
