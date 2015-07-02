<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'sale/',
    ],
    function () {

        Route::group(['before' => 'pr:77'], function () {

            Route::get('create', [
                'as'   => 'sale.create',
                'uses' => 'SaleController@create',
            ]);

        });

        Route::group(['before' => 'pr:78'], function () {

            Route::get('{id}/edit', [
                'as'   => 'sale.edit',
                'uses' => 'SaleController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'sale.update',
                'uses' => 'SaleController@update',
            ]);

        });

        Route::group(['before' => 'pr:114'], function () {

            Route::get('cancellations', [
                'as' => 'sale.cancellations',
                'uses' => 'SaleController@cancellations',
            ]);

        });

        Route::group(['before' => 'pr:80'], function () {

            Route::put('adjust/{id}', [
                'as'   => 'sale.adjust.price',
                'uses' => 'SaleController@adjustPrice',
            ]);

        });

        Route::group(['before' => 'pr:81,87'], function () {

            Route::delete('{id}', [
                'as'   => 'sale.destroy',
                'uses' => 'SaleController@destroy',
            ]);

        });

        Route::group(['before' => 'pr:81'], function () {

            Route::post('{id}/cancel', [
                'as'   => 'sale.cancel',
                'uses' => 'SaleController@cancel',
            ]);

        });

        Route::group(['before' => 'pr:78,86,95,107'], function () {

            Route::get('stop/{id}', [
                'as'   => 'sale.stop',
                'uses' => 'SaleController@stopRegisterMovements',
            ]);

            Route::get('start/{id}', [
                'as'   => 'sale.start',
                'uses' => 'SaleController@startRegisterMovements',
            ]);

        });

        Route::group(['before' => 'pr:76'], function () {

            Route::get('', [
                'as'   => 'sale.index',
                'uses' => 'SaleController@index',
            ]);

            Route::get('search/{type}', [
                'as'   => 'sale.search',
                'uses' => 'SaleController@search',
            ]);

            Route::get('{id}', [
                'as'   => 'sale.show',
                'uses' => 'SaleController@show',
            ]);

        });

        Route::get('print/generate/{id}', [
            'as'   => 'sale.print.generate',
            'uses' => 'SaleController@generatePrint',
        ]);

        Route::get('print/{folio}/{id}', [
            'as'   => 'sale.print',
            'uses' => 'SaleController@salePrint',
        ]);

    }
);
