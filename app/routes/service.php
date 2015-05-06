<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'service/',
    ],
    function () {

        Route::group(['before' => 'pr:94'], function () {

            Route::get('create', [
                'as' => 'service.create',
                'uses' => 'ServiceController@create',
            ]);

        });

        Route::group(['before' => 'pr:95'], function () {

            Route::get('{id}/edit', [
                'as'   => 'service.edit',
                'uses' => 'ServiceController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'service.update',
                'uses' => 'ServiceController@update',
            ]);

        });

        Route::group(['before' => 'pr:93'], function () {

            Route::get('', [
                'as'   => 'service.index',
                'uses' => 'ServiceController@index',
            ]);

            Route::get('search/{type}', [
                'as'   => 'service.search',
                'uses' => 'ServiceController@search',
            ]);

            Route::get('{id}', [
                'as'   => 'service.show',
                'uses' => 'ServiceController@show',
            ]);

        });

        Route::group(['before' => 'pr:96'], function () {

            Route::delete('{id}', [
                'as'   => 'service.destroy',
                'uses' => 'SaleController@destroy',
            ]);

        });

        Route::group(['before' => 'pr:98'], function () {

            Route::post('finish/{id}', [
                'as'   => 'service.finish',
                'uses' => 'ServiceController@finish',
            ]);

        });

        Route::group(['before' => 'pr:100'], function () {

            Route::post('restart/{id}', [
                'as'   => 'service.restart',
                'uses' => 'ServiceController@restart',
            ]);

        });

        Route::group(['before' => 'pr:97'], function () {

            Route::put('delivery/date/{id}', [
                'as'   => 'service.edit.delivery.date',
                'uses' => 'SaleController@editDeliveryDate',
            ]);

        });

        // cancelar
        Route::group(['before' => 'pr:104'], function () {

            Route::post('{id}/cancel', [
                'as'   => 'service.cancel',
                'uses' => 'ServiceController@cancel',
            ]);

        });

        Route::get('print/generate/{id}', [
            'as'   => 'service.print.generate',
            'uses' => 'ServiceController@generatePrint',
        ]);

        Route::get('print/{folio}/{id}', [
            'as'   => 'service.print',
            'uses' => 'ServiceController@servicePrint',
        ]);

        Route::get('authorization/{id}', [
            'as'   => 'service.authorization',
            'uses' => 'ServiceController@setAuthorization',
        ]);

        Route::get('continue/{id}', [
            'as'   => 'service.continue',
            'uses' => 'ServiceController@setContinue',
        ]);

    }
);
