<?php

/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'inventory/',
        'before' => 'pr:54',
    ],
    function () {

        Route::group(['before' => 'pr:55'], function () {

            Route::get('create/{type}', [
                'as'   => 'product.create',
                'uses' => 'ProductController@create',
            ]);

            Route::post('', [
                'as'   => 'product.store',
                'uses' => 'ProductController@store',
            ]);

        });

        Route::group(['before' => 'pr:55'], function () {

            Route::get('{slug}/{id}/edit', [
                'as'   => 'product.edit',
                'uses' => 'ProductController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'product.update',
                'uses' => 'ProductController@update',
            ]);

            Route::get('{slug}/{id}/change-prices/{movement_id}', [
                'as'   => 'product.change.prices',
                'uses' => 'ProductController@priceEdit'
            ]);

            Route::put('{id}/update-prices', [
                'as'   => 'product.update.prices',
                'uses' => 'ProductController@priceUpdate',
            ]);

        });

        Route::group(['before' => 'pr:57'], function () {

            Route::get('soft/delete/{id}', [
                'as'   => 'product.soft.delete',
                'uses' => 'ProductController@softDelete',
            ]);

        });

        Route::group(['before' => 'pr:55'], function () {

            Route::delete('{id}', [
                'as'   => 'product.destroy',
                'uses' => 'ProductController@destroy',
            ]);

        });

        Route::group(['before' => 'pr:58'], function () {

            Route::get('restore/{id}', [
                'as'   => 'product.restore',
                'uses' => 'ProductController@restore',
            ]);

        });

        Route::get('products', [
            'as'   => 'product.index.product',
            'uses' => 'ProductController@indexProducts',
        ]);

        Route::get('services', [
            'as'   => 'product.index.service',
            'uses' => 'ProductController@indexServices',
        ]);

        Route::get('trash', [
            'as'   => 'product.trash',
            'uses' => 'ProductController@trash',
        ]);

        Route::get('print/{product_id}', [
            'as'   => 'product.print.barcode',
            'uses' => 'ProductController@printBarcode'
        ]);

        Route::get('print_tag/{product_id}', [
            'as'   => 'product.print.product.tag',
            'uses' => 'ProductController@printTag'
        ]);

        Route::get('details/{id}', [
            'as'   => 'product.show.min',
            'uses' => 'ProductController@showMin'
        ]);

        Route::get('{slug}/{id}', [
            'as'   => 'product.show',
            'uses' => 'ProductController@show',
        ]);

        Route::get('search/q/{type}', [
            'as'   => 'product.search',
            'uses' => 'ProductController@search',
        ]);

    }
);

Route::get('api/product/prices/{barcode}', [
    'as' => 'api.product.prices',
    'uses' => 'ProductController@getProduct',
]);

Route::get('api/product/search/{type}/{active}', [
    'as' => 'api.product.search',
    'uses' => 'ProductController@getSearch',
]);