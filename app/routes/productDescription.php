<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'description/',
    ],
    function () {

        Route::get('create/{slug}/{id}', [
            'as'   => 'product.description.create',
            'uses' => 'ProductDescriptionController@create',
        ]);

        Route::post('', [
            'as'   => 'product.description.store',
            'uses' => 'ProductDescriptionController@store',
        ]);

        Route::get('{slug}/{id}/edit', [
            'as'   => 'product.description.edit',
            'uses' => 'ProductDescriptionController@edit',
        ]);

        Route::put('{id}', [
            'as'   => 'product.description.update',
            'uses' => 'ProductDescriptionController@update',
        ]);

    }
);
