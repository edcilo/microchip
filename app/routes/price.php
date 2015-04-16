<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'price/'
    ],
    function ()
    {

        //Route::group(['before' => 'pr:81'], function () {});
        Route::group(['before' => 'pr:106'], function () {

            Route::get('create', [
                'as'   => 'price.create',
                'uses' => 'PriceController@create'
            ]);

        });

        Route::group(['before' => 'pr:107'], function () {

            Route::get('{id}/edit', [
                'as'   => 'price.edit',
                'uses' => 'PriceController@edit'
            ]);

            Route::put('{id}', [
                'as'   => 'price.update',
                'uses' => 'PriceController@update'
            ]);

        });

        Route::group(['before' => 'pr:108'], function () {

            Route::delete('{id}', [
                'as'   => 'price.destroy',
                'uses' => 'PriceController@destroy'
            ]);

        });

        Route::group(['before' => 'pr:105'], function () {

            Route::get('', [
                'as'   => 'price.index',
                'uses' => 'PriceController@index'
            ]);

            Route::get('search', [
                'as'   => 'price.search',
                'uses' => 'PriceController@search'
            ]);

            Route::get('{slug}/{id}', [
                'as'   => 'price.show',
                'uses' => 'PriceController@show'
            ]);

        });

        Route::get('incomplete', [
            'as'   => 'price.incomplete',
            'uses' => 'PriceController@incomplete'
        ]);



        Route::get('print/generate/{id}', [
            'as'   => 'price.print.generate',
            'uses' => 'PriceController@generatePrint'
        ]);

        Route::get('clone/{price_id}', [
            'as'   => 'price.clone',
            'uses' => 'PriceController@clonePrice'
        ]);

        Route::get('print/{folio}/{id}', [
            'as'   => 'price.print',
            'uses' => 'PriceController@pricePrint'
        ]);

        Route::get('stop/{id}', [
            'as'   => 'price.stop',
            'uses' => 'PriceController@stopRegisterMovements'
        ]);

        Route::post('toOrder/{id}', [
            'as'   => 'price.to.order',
            'uses' => 'PriceController@toOrder'
        ]);


        Route::group(['before' => 'pr:101'], function () {

            Route::post('toOrderOne/{id}', [
                'as'   => 'price.to.order.one',
                'uses' => 'PriceController@toOrderOne'
            ]);

        });

        Route::put('adjust/{id}', [
            'as'   => 'price.adjust.price',
            'uses' => 'PriceController@adjustprice'
        ]);

    }
);