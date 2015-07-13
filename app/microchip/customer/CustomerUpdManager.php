<?php

namespace microchip\customer;

use microchip\base\BaseManager;

class CustomerUpdManager extends BaseManager
{
    public function getRules()
    {
        return $rules = [
            'prefix'           => 'max:120',
            'name'             => 'required|max:255',
            'country'          => 'max:255',
            'state'            => 'max:255',
            'city'             => 'max:255',
            'postcode'         => 'integer|digits:5',
            'colony'           => 'max:255',
            'address'          => 'max:255',
            'shipping_address' => '',
            'birthday'         => 'date',
            'phone'            => 'max:120',
            'cellphone'        => 'max:120',
            'email'            => 'email|unique:customers,email,'.$this->entity->id,
            'rfc'              => 'required_if:legal_concept,Persona Física,Persona Moral|unique:customers,rfc,'.$this->entity->id,
            'credit_limit'     => 'numeric',
            'credit_days'      => 'integer',
            'card_id'          => 'max:255|unique:customers,card_id,'.$this->entity->id,
            'points'           => 'float',
            'expiration'       => 'integer',
            'classification'   => 'required|in:Distribuidor,Cliente',
            'legal_concept'    => 'in:Ninguno,Persona Física,Persona Moral',
        ];
    }

    public function prepareData($data)
    {
        $data['slug'] = \Str::slug($data['name']);
        $data['rfc']  = strtoupper($data['rfc']);

        if (!empty($data['card_id']) && $data['card_id'] != $this->entity->card_id) {
            $data['card_active'] = date('Y-m-d');
        }

        return $data;
    }
}
