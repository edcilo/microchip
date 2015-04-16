<?php namespace microchip\user;

use microchip\base\BaseManager;

class UserUpdManager extends BaseManager {

    public function getRules()
    {
        return $rules = [
            'username'       => 'required|max:255|unique:users,username,' . $this->entity->id,
            'password'       => 'min:8|max:255',
            'department_id'  => 'required|exists:departments,id',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data, ['password']);

        if ( empty($data['password']) )
        {
            $data['password'] = $this->entity->password;
        }
        else
        {
            $data['password'] = \Hash::make($data['password']);
        }

        $data['slug']     = \Str::slug($data['username']);

        return $data;
    }

}