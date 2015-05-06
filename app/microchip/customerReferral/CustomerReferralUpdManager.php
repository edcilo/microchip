<?php

namespace microchip\customerReferral;

use microchip\base\BaseManager;

class CustomerReferralUpdManager extends BaseManager
{
    public function getRules()
    {
        return [
            'expiration' => 'required|integer',
        ];
    }

    public function prepareData($data)
    {
        $data['customer_id'] = $this->entity->customer_id;
        $data['referred_id'] = $this->entity->referred_id;
        $data['observations'] = $this->entity->observations;

        return $data;
    }
}
