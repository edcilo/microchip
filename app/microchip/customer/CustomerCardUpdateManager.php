<?php namespace microchip\customer;

use microchip\base\BaseManager;

class CustomerCardUpdateManager extends BaseManager {

    public function getRules()
    {
        return $rules = [
            'card_id'    => 'required|max:255|unique:customers,card_id,' . $this->entity->id,
            'expiration' => 'integer',
        ];
    }

    public function prepareData($data)
    {
        if ( !empty( $data['card_id'] ) && $data['card_id'] != $this->entity->card_id )
        {
            $data['card_active'] = date('Y-m-d');
        }

        return $data;
    }

}