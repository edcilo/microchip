<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'price/',
    ],
    function () {

        Route::group(['before' => 'pr:106'], function () {

            Route::get('create', [
                'as'   => 'price.create',
                'uses' => 'PriceController@create',
            ]);

        });

        Route::group(['before' => 'pr:107'], function () {

            Route::get('{id}/edit', [
                'as'   => 'price.edit',
                'uses' => 'PriceController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'price.update',
                'uses' => 'PriceController@update',
            ]);

        });

        Route::group(['before' => 'pr:108'], function () {

            Route::delete('{id}', [
                'as'   => 'price.destroy',
                'uses' => 'SaleController@destroy',
            ]);

        });

        Route::group(['before' => 'pr:109'], function () {

            Route::get('clone/{price_id}', [
                'as'   => 'price.clone',
                'uses' => 'PriceController@clonePrice',
            ]);

        });

        Route::group(['before' => 'pr:105'], function () {

            Route::get('', [
                'as'   => 'price.index',
                'uses' => 'PriceController@index',
            ]);

            Route::get('search/{type}', [
                'as'   => 'price.search',
                'uses' => 'PriceController@search',
            ]);

            Route::get('{id}', [
                'as'   => 'price.show',
                'uses' => 'PriceController@show',
            ]);

        });

        Route::group(['before' => 'pr:101,110'], function () {

            Route::post('toOrderOne/{id}', [
                'as'   => 'price.to.order.one',
                'uses' => 'PriceController@toOrderOne',
            ]);

            Route::delete('disorderOne/{id}', [
                'as'   => 'price.disorder.one',
                'uses' => 'PriceController@disorderOne',
            ]);

        });

        Route::group(['before' => 'pr:101,110'], function () {

            Route::post('toOrder/{id}', [
                'as'   => 'price.to.order',
                'uses' => 'PriceController@toOrder',
            ]);

        });

        Route::get('print/generate/large/{id}', [
            'as'   => 'price.print.generate_large',
            'uses' => 'PriceController@generatePrintLarge'
        ]);

        Route::get('print/generate/{id}', [
            'as'   => 'price.print.generate',
            'uses' => 'PriceController@generatePrint',
        ]);

        Route::get('print/{folio}/{id}', [
            'as'   => 'price.print',
            'uses' => 'PriceController@pricePrint',
        ]);

    }
);
