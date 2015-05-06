<?php

$prefix = '';

Route::group(
    [
        'prefix' => $prefix,
        'before' => 'guest',
    ],
    function () {

        Route::get('', [
            'as'   => 'home.index',
            'uses' => 'HomeController@index',
        ]);

        Route::post('aut/login', [
            'as'   => 'auth.login',
            'uses' => 'AuthController@login',
        ]);

    }
);

Route::group(
    [
        'prefix' => $prefix,
        'before' => 'auth',
    ],
    function () {

        Route::get('ventas', [
            'as'   => 'home.sale',
            'uses' => 'HomeController@sale',
        ]);

        Route::get('auth/logout', [
            'as'   => 'auth.logout',
            'uses' => 'AuthController@logout',
        ]);

    }
);
