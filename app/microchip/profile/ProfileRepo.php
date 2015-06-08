<?php

namespace microchip\profile;

use microchip\base\BaseRepo;

class ProfileRepo extends BaseRepo
{
    public function getModel()
    {
        return new Profile();
    }

    public function newProfile()
    {
        return $profile = new Profile();
    }

    public function search($terms, $request = '', $take = 10)
    {
        $q = Profile::leftJoin('users', 'profiles.user_id', '=', 'users.id')
            ->where('name', 'like', "%$terms%")
            ->orwhere('f_last_name', 'like', "%$terms%")
            ->orwhere('s_last_name', 'like', "%$terms%")
            ->orwhere('email', 'like', "%$terms%")
            ->orwhere('observations', 'like', "%$terms%")
            ->with('user');

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }
}
