<?php

namespace microchip\user;

use microchip\base\BaseManager;

class UserRegManager extends BaseManager
{
    public function getRules()
    {
        return $rules = [
            'username'       => 'required|max:255|unique:users,username',
            'password'       => 'required|min:8|max:255',
            'department_id'  => 'required|exists:departments,id',

            'name'           => 'required|max:255',
            'f_last_name'    => 'required|max:255',
            's_last_name'    => 'required|max:255',
            'photo'          => 'image',
            'birthday'       => 'required|date',
            'sex'            => 'required|in:Masculino,Femenino',
            'phone'          => 'numeric|min:6',
            'cellphone'      => 'numeric|min:6',
            'email'          => 'required|email',
            'country'        => 'required|max:255',
            'state'          => 'required|max:255',
            'postcode'       => 'required|integer|digits:5',
            'city'           => 'required|max:255',
            'colony'         => 'required|max:255',
            'address'        => 'required|max:255',
            'marital_status' => 'required|in:Casado,Soltero',
            'wife'           => 'max:255',
            'reference_1'    => 'required|max:255',
            'reference_2'    => 'required|max:255',
            'reference_3'    => 'required|max:255',
            'ref_phone_1'    => 'numeric|min:6',
            'ref_phone_2'    => 'numeric|min:6',
            'ref_phone_3'    => 'numeric|min:6',
            'hired'          => 'required|date',
            'salary'         => 'required|numeric',
            'commission'     => 'required|numeric',
            'goal'           => 'required|numeric',
            'current'        => 'numeric',
            'fired'          => 'date',
            'reason'         => 'max:1020',
            'observations'   => 'max:510',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data, ['password']);

        $data['password'] = \Hash::make($data['password']);

        $data['slug']     = \Str::slug($data['username']);
        $data['active']   = 1;

        $data['current']  = 0;

        return $data;
    }
}
