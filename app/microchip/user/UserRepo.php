<?php

namespace microchip\user;

use Illuminate\Support\Facades\Hash;
use microchip\base\BaseRepo;

class UserRepo extends BaseRepo
{
    public function getModel()
    {
        return new User();
    }

    public function newUser()
    {
        return $user = new User();
    }

    public function checkPassword($password)
    {
        $users = User::all();

        foreach ($users as $user) {
            if (Hash::check($password, $user->password)) {
                return true;
            }
        }

        return false;
    }

    public function getUserByPassword($password)
    {
        $users = User::all();

        foreach ($users as $user) {
            if (Hash::check($password, $user->password)) {
                return $user;
            }
        }

        return false;
    }

    public function getPaysByRange($date_init, $date_end = null)
    {
        return User::with(['pays' => function ($query) use ($date_init, $date_end) {
            $query->with('sale')
                ->where('date', '>=', $date_init)
                ->where(function ($query) use ($date_end)
                {
                    if (!is_null($date_end)) {
                        $query->where('date', '<=', $date_end);
                    }
                });
        }])->get();
    }
}
