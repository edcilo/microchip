<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'permission/',
        'before' => 'pr:49',
    ],
    function () {

        Route::get('', [
            'as'   => 'permission.index',
            'uses' => 'PermissionController@index',
        ]);

        Route::group(['before' => 'pr:50'], function () {

            Route::get('{id}/edit', [
                'as'   => 'permission.edit',
                'uses' => 'PermissionController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'permission.update',
                'uses' => 'PermissionController@update',
            ]);

        });

        Route::group(['before' => 'pr:34'], function () {

            Route::get('edit/{user_id}', [
                'as'   => 'permission.user.edit',
                'uses' => 'PermissionController@editUser',
            ]);

            Route::post('update/{user_id}', [
                'as'   => 'permission.user.update',
                'uses' => 'PermissionController@updateUser',
            ]);

            Route::post('destroy/{user_id}', [
                'as'   => 'permission.user.destroy',
                'uses' => 'PermissionController@destroyUser',
            ]);

        });

        Route::get('{id}', [
            'as'    => 'permission.show',
            'uses'  => 'PermissionController@show',
        ]);

    }
);
