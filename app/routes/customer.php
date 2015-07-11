<?php

/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'customer/',
        'before' => 'pr:63',
    ],
    function () {

        Route::get('', [
            'as'   => 'customer.index',
            'uses' => 'CustomerController@index',
        ]);

        Route::group(['before' => 'pr:64'], function () {

            Route::get('create', [
                'as'   => 'customer.create',
                'uses' => 'CustomerController@create',
            ]);

            Route::get('create/window', [
                'as'   => 'customer.create.min',
                'uses' => 'CustomerController@createMin'
            ]);

            Route::post('', [
                'as'   => 'customer.store',
                'uses' => 'CustomerController@store',
            ]);

        });

        Route::group(['before' => 'pr:65'], function () {

            Route::get('card/{id}', [
                'as'   => 'customer.card.edit',
                'uses' => 'CustomerController@cardEdit',
            ]);

            Route::put('card/{id}', [
                'as'   => 'customer.card.update',
                'uses' => 'CustomerController@cardUpdate',
            ]);

            Route::get('{slug}/{id}/edit', [
                'as'   => 'customer.edit',
                'uses' => 'CustomerController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'customer.update',
                'uses' => 'CustomerController@update',
            ]);

        });

        Route::group(['before' => 'pr:66'], function () {

            Route::get('soft/delete/{id}', [
                'as'   => 'customer.soft.delete',
                'uses' => 'CustomerController@softDelete',
            ]);

        });

        Route::group(['before' => 'pr:67'], function () {

            Route::get('restore/{id}', [
                'as'   => 'customer.restore',
                'uses' => 'CustomerController@restore',
            ]);

        });

        Route::group(['before' => 'pr:68'], function () {

            Route::delete('{id}', [
                'as'   => 'customer.destroy',
                'uses' => 'CustomerController@destroy',
            ]);

        });

        Route::get('trash', [
            'as'   => 'customer.trash',
            'uses' => 'CustomerController@trash',
        ]);

        Route::get('{slug}/{id}', [
            'as'   => 'customer.show',
            'uses' => 'CustomerController@show',
        ]);

        Route::get('search', [
            'as'   => 'customer.search',
            'uses' => 'CustomerController@search',
        ]);

    }
);

Route::get('api/customer/card', [
    'as' => 'api.customer.card.get',
    'uses' => 'CustomerController@getCustomerByCard'
]);

Route::get('api/customer/{id}', [
    'as' => 'api.customer.get',
    'uses' => 'CustomerController@getCustomer',
]);

Route::get('response/customer/confirm/{id}', [
    'as'   => 'customer.confirm',
    'uses' => 'CustomerController@confirm'
]);