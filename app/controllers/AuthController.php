<?php

use microchip\user\UserRepo;

class AuthController extends \BaseController
{
    protected $userRepo;

    public function __construct(
        UserRepo    $userRepo
    ) {
        $this->userRepo = $userRepo;
    }

    public function login()
    {
        $data = Input::all();

        $user = $this->userRepo->getUserByPassword($data['password']);

        if ($user AND $user->active) {
            Auth::login($user);

            return Redirect::route('home.sale');
        }

        return Redirect::back()->with('login_error', 1);
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::route('home.index');
    }
}
