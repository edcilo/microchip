<?php namespace microchip\bank;

use microchip\base\BaseManager;

class BankUpdManager extends BaseManager {

    public function getRules()
    {
        return [
            'name'               => 'required|max:255',
            'number_account'     => 'required|numeric|digits:11|unique:banks,number_account,' . $this->entity->id,
            'branch'             => 'required|max:255',
            'clabe'              => 'required|numeric|digits:18|unique:banks,clabe,' . $this->entity->id,
            'executive_name'     => 'max:255',
            'active'             => 'in:0,1',
            'phone'              => 'numeric|min:6',
            'country'            => 'max:255',
            'state'              => 'max:255',
            'city'               => 'max:255',
            'postcode'           => 'max:255',
            'colony'             => 'max:255',
            'address'            => 'max:255',
            'terminal'           => 'in:0,1',
            'commission_debit'   => 'numeric',
            'commission_credit'  => 'numeric',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['terminal']           = ( !isset($data['terminal']) ) ? 0 : $data['terminal'];

        $data['commission_debit']   = ( $data['terminal'] == 1 ) ? $data['commission_debit'] : 0 ;
        $data['commission_credit']  = ( $data['terminal'] == 1 ) ? $data['commission_credit'] : 0 ;

        $data['slug'] = \Str::slug($data['name']);

        return $data;
    }

}