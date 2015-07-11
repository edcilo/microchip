<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'order/',
    ],
    function () {

        Route::group(['before' => 'pr:85'], function () {

            Route::get('create', [
                'as'   => 'order.create',
                'uses' => 'OrderController@create',
            ]);

            Route::post('', [
                'as'   => 'order.store',
                'uses' => 'OrderController@store',
            ]);

        });

        Route::group(['before' => 'pr:86'], function () {

            Route::get('{id}/edit', [
                'as'   => 'order.edit',
                'uses' => 'OrderController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'order.update',
                'uses' => 'OrderController@update',
            ]);

        });

        Route::group(['before' => 'pr:87'], function () {

            Route::delete('{id}', [
                'as'   => 'order.destroy',
                'uses' => 'SaleController@destroy',
            ]);

        });

        // cancelar
        Route::group(['before' => 'pr:89'], function () {

            Route::post('{id}/cancel', [
                'as'   => 'order.cancel',
                'uses' => 'OrderController@cancel',
            ]);

        });

        // vender pedido
        Route::group(['before' => 'pr:88,99'], function () {

            Route::post('toSale/{id}', [
                'as'   => 'order.to.sale',
                'uses' => 'OrderController@toSale',
            ]);

        });

        Route::group(['before' => 'pr:84'], function () {

            Route::get('', [
                'as'   => 'order.index',
                'uses' => 'OrderController@index',
            ]);

            Route::get('search/{type}', [
                'as'   => 'order.search',
                'uses' => 'OrderController@search',
            ]);

            Route::get('{id}', [
                'as'   => 'order.show',
                'uses' => 'OrderController@show',
            ]);

        });

        Route::get('print/generate/{id}', [
            'as'   => 'order.print.generate',
            'uses' => 'OrderController@generatePrint',
        ]);

        Route::get('print/generate/large/{id}', [
            'as'   => 'order.print.generate_large',
            'uses' => 'OrderController@generatePrintLarge'
        ]);

        Route::get('print/{folio}/{id}', [
            'as'   => 'order.print',
            'uses' => 'OrderController@orderPrint',
        ]);

    }
);
