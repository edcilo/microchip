<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'user/',
        'before' => 'pr:24'
    ],
    function ()
    {

        Route::get('', [
            'as'   => 'user.index',
            'uses' => 'UserController@index'
        ]);

        Route::group(['before' => 'pr:25'], function () {

            Route::get('create', [
                'as'   => 'user.create',
                'uses' => 'UserController@create'
            ]);

            Route::post('', [
                'as'   => 'user.store',
                'uses' => 'UserController@store'
            ]);

        });

        Route::group(['before' => 'pr:26'], function () {

            Route::get('profile/{slug}/{id}/edit', [
                'as'   => 'user.profile.edit',
                'uses' => 'UserController@editProfile'
            ]);

            Route::put('profile/{id}', [
                'as'   => 'user.profile.update',
                'uses' => 'UserController@updateProfile'
            ]);

        });

        Route::group(['before' => 'pr:27'], function () {

            Route::get('{slug}/{id}/edit', [
                'as'   => 'user.edit',
                'uses' => 'UserController@edit'
            ]);

            Route::put('{id}', [
                'as'   => 'user.update',
                'uses' => 'UserController@update'
            ]);

        });

        Route::group(['before' => 'pr:28'], function () {

            Route::get('soft/delete/{id}',[
                'as'   => 'user.soft.delete',
                'uses' => 'UserController@softDelete'
            ]);

        });

        Route::group(['before' => 'pr:29'], function () {

            Route::get('restore/{id}', [
                'as'   => 'user.restore',
                'uses' => 'UserController@restore'
            ]);

        });

        Route::group(['before' => 'pr:30'], function () {

            Route::delete('{id}', [
                'as'   => 'user.destroy',
                'uses' => 'UserController@destroy'
            ]);

        });

        Route::group(['before' => 'pr:32'], function () {

            Route::get('pay/{id}', [
                'as'   => 'user.pay',
                'uses' => 'UserController@pay'
            ]);

        });



        Route::get('trash', [
            'as'   => 'user.trash',
            'uses' => 'UserController@trash'
        ]);

        Route::get('{slug}/{id}', [
            'as'   => 'user.show',
            'uses' => 'UserController@show'
        ]);

        Route::get('search', [
            'as'   => 'user.search',
            'uses' => 'UserController@search'
        ]);

    }
);