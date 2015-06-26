<?php

/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'movement/',
        'before' => 'pr:51',
    ],
    function () {

        Route::group(['before' => 'pr:51'], function () {

            Route::get('', [
                'as'   => 'movement.index',
                'uses' => 'InventoryMovementController@index',
            ]);

            Route::group(['before' => 'pr:52'], function () {

                Route::get('create', [
                    'as'   => 'movement.create',
                    'uses' => 'InventoryMovementController@create',
                ]);

                Route::post('', [
                    'as'   => 'movement.store',
                    'uses' => 'InventoryMovementController@store',
                ]);

            });

            Route::group(['before' => 'pr:53'], function () {

                Route::delete('{id}/simple', [
                    'as'   => 'movement.destroy.simple',
                    'uses' => 'InventoryMovementController@destroySimple',
                ]);

            });

            Route::get('{id}', [
                'as'   => 'movement.show',
                'uses' => 'InventoryMovementController@show',
            ]);

        });

        Route::group(['before' => 'pr:61'], function () {

            Route::get('purchase/create', [
                'as'   => 'movement.purchase.create',
                'uses' => 'InventoryMovementController@purchaseCreate',
            ]);

            Route::post('purchase', [
                'as'   => 'movement.purchase.store',
                'uses' => 'InventoryMovementController@purchaseStore',
            ]);

        });

        Route::group(['before' => 'pr:78,85,94,106'], function () {

            Route::get('sale/create', [
                'as'   => 'movement.sale.create',
                'uses' => 'InventoryMovementController@saleCreate',
            ]);

            Route::post('sale', [
                'as'   => 'movement.sale.store',
                'uses' => 'InventoryMovementController@saleStore',
            ]);

        });

        Route::group(['before' => 'pr:61,78,86,94,106'], function () {

            Route::delete('{id}', [
                'as'   => 'movement.destroy',
                'uses' => 'InventoryMovementController@destroy',
            ]);

        });

        Route::get('{id}/get/series', [
            'as'   => 'movement.get.series',
            'uses' => 'InventoryMovementController@getSeries'
        ]);

    }
);
