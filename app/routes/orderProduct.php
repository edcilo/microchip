<?php
/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'order_product/'
    ],
    function ()
    {

        Route::get('create', [
            'as'   => 'order.product.create',
            'uses' => 'OrderProductController@create'
        ]);

        Route::group(['before' => 'pr:103'], function () {

            Route::get('support/{id}', [
                'as' => 'order.product.support',
                'uses' => 'OrderProductController@support'
            ]);

            Route::post('permission/up/{id}', [
                'as'   => 'order.product.permission',
                'uses' => 'OrderProductController@permission'
            ]);

            Route::post('permission/down/{id}', [
                'as'   => 'order.product.permission.down',
                'uses' => 'OrderProductController@permissionDown'
            ]);

        });

        Route::group(['before' => 'pr:90,102,112'], function () {

            Route::post('', [
                'as'   => 'order.product.store',
                'uses' => 'OrderProductController@store'
            ]);

        });

        Route::group(['before' => 'pr:90,102,113'], function () {

            Route::delete('{id}', [
                'as'   => 'order.product.destroy',
                'uses' => 'OrderProductController@destroy'
            ]);

        });

        Route::group(['before' => 'pr:111'], function () {

            Route::get('', [
                'as'   => 'order.product.index',
                'uses' => 'OrderProductController@index'
            ]);

        });

        Route::get('{id}', [
            'as'   => 'order.product.show',
            'uses' => 'OrderProductController@edit'
        ]);


        Route::get('{slug}/{id}/edit', [
            'as'   => 'order.product.edit',
            'uses' => 'OrderProductController@update'
        ]);

        Route::put('{id}', [
            'as'   => 'order.product.update',
            'uses' => 'OrderProductController@show'
        ]);



    }
);