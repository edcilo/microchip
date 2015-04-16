<?php namespace microchip\provider;

use microchip\base\BaseManager;


class ProviderUpdManager extends BaseManager {

    public function getRules()
    {
        return [
            'name'              => 'required|max:255|unique:providers,name,' . $this->entity->id,
            'rfc'               => 'max:255',
            'email'             => 'email',
            'number'            => 'numeric',
            'classification'    => 'max:255',
            'state'            => 'max:255',
            'city'              => 'max:255',
            'postcode'          => 'integer|digits:5',
            'address'           => 'max:255',
            'address_warranty'  => 'max:255',
            'days_credit'       => 'integer',
            'credit_limit'      => 'numeric',
            'observations'      => '',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['active'] = 1;
        $data['slug']   = \Str::slug($data['name']);

        return $data;
    }

}