<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'series/',
    ],
    function () {

        Route::get('', [
            'as'   => 'series.index',
            'uses' => 'SeriesController@index',
        ]);

        Route::get('create/purchase/{movement_id}/{product_id}', [
            'as'   => 'series.create.purchase',
            'uses' => 'SeriesController@createPurchase',
        ]);

        Route::group(['before' => 'pr:61'], function () {

            Route::post('purchase', [
                'as'   => 'series.purchase.store',
                'uses' => 'SeriesController@storePurchase',
            ]);

        });

        Route::get('create/sale/{movement_id}', [
            'as'   => 'series.create.sale',
            'uses' => 'SeriesController@createSale',
        ]);

        Route::get('create/separate/{order_product_id}', [
            'as'   => 'series.create.separate',
            'uses' => 'SeriesController@createSeparate',
        ]);

        Route::get('create/price/{product_id}', [
            'as'   => 'series.create.price',
            'uses' => 'SeriesController@createPrice',
        ]);

        Route::get('create/{movement_id}', [
            'as'   => 'series.create',
            'uses' => 'SeriesController@create',
        ]);

        Route::post('', [
            'as'   => 'series.store',
            'uses' => 'SeriesController@store',
        ]);

        Route::post('sale', [
            'as'   => 'series.sale.store',
            'uses' => 'SeriesController@storeSale',
        ]);

        Route::post('separate', [
            'as'   => 'series.separated.store',
            'uses' => 'SeriesController@storeSeparate',
        ]);

        Route::get('{slug}/{id}', [
            'as'   => 'series.show',
            'uses' => 'SeriesController@show',
        ]);

        Route::get('{slug}/{id}/edit', [
            'as'   => 'series.edit',
            'uses' => 'SeriesController@edit',
        ]);

        Route::put('{id}', [
            'as'   => 'series.update',
            'uses' => 'SeriesController@update',
        ]);

        Route::delete('{id}', [
            'as'   => 'series.destroy',
            'uses' => 'SeriesController@destroy',
        ]);

        Route::get('search', [
            'as'   => 'series.search',
            'uses' => 'SeriesController@search',
        ]);

    }
);
