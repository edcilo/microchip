<?php namespace microchip\customer;

use microchip\base\BaseManager;

class CustomerRegManager extends BaseManager {

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
            'email'            => 'email|unique:customers,email',
            'rfc'              => 'required_if:legal_concept,Persona Física,Persona Moral|size:13',
            'credit_limit'     => 'numeric',
            'credit_days'      => 'integer',
            'card_id'          => 'max:255|unique:customers,card_id',
            'points'           => 'float',
            'expiration'       => 'integer',
            'classification'   => 'required|in:Distribuidor,Cliente',
            'legal_concept'    => 'in:Ninguno,Persona Física,Persona Moral',

            'customer'              => 'required|boolean',
            'customer_id'           => 'required_if:customer,1|exists:customers,id',
            'observations'          => '',
            'expiration_referrals'  => 'required_if:customer,1|integer',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['active'] = 1;
        $data['slug']   = \Str::slug($data['name']);
        $data['rfc']    = strtoupper($data['rfc']);

        if ( ! empty( $data['card_id'] ) )
        {
            $data['card_active'] = date('Y-m-d');
        }

        return $data;
    }

}