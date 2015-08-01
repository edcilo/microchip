<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'purchase/',
        'before' => 'pr:60',
    ],
    function () {

        Route::get('', [
            'as'   => 'purchase.index',
            'uses' => 'PurchaseController@index',
        ]);

        Route::get('incomplete', [
            'as'   => 'purchase.incomplete',
            'uses' => 'PurchaseController@incomplete',
        ]);

        Route::group(['before' => 'pr:61'], function () {

            Route::get('create', [
                'as'   => 'purchase.create',
                'uses' => 'PurchaseController@create',
            ]);

            Route::get('upload/{id}', [
                'as'   => 'purchase.upload',
                'uses' => 'PurchaseController@upload',
            ]);

            Route::get('stop/{id}', [
                'as'   => 'purchase.stop',
                'uses' => 'PurchaseController@stopRegisterMovements',
            ]);

            Route::post('check/prices/{id}', [
                'as'   => 'purchase.check.prices',
                'uses' => 'PurchaseController@checkPrices'
            ]);

            Route::delete('uncheck/prices/{id}', [
                'as'   => 'purchase.uncheck.prices',
                'uses' => 'PurchaseController@uncheckPrices'
            ]);

            Route::post('save/{id}', [
                'as'   => 'purchase.save',
                'uses' => 'PurchaseController@save',
            ]);

            Route::post('', [
                'as'   => 'purchase.store',
                'uses' => 'PurchaseController@store',
            ]);

        });

        Route::group(['before' => 'pr:62'], function () {

            Route::delete('{id}', [
                'as'   => 'purchase.destroy',
                'uses' => 'PurchaseController@destroy',
            ]);

        });

        Route::get('{slug}/{id}/edit', [
            'as'   => 'purchase.edit',
            'uses' => 'PurchaseController@edit',
        ]);

        Route::put('{id}/purchase/update', [
            'as'   => 'purchase.update',
            'uses' => 'PurchaseController@update',
        ]);

        Route::post('{id}/products/edit', [
            'as'   => 'purchase.products.edit',
            'uses' => 'PurchaseController@productsUpdate'
        ]);

        Route::get('{slug}/{id}', [
            'as'   => 'purchase.show',
            'uses' => 'PurchaseController@show',
        ]);

        Route::get('search', [
            'as'   => 'purchase.search',
            'uses' => 'PurchaseController@search',
        ]);

    }
);
