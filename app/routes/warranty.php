<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'warranty/',
    ],
    function () {

        Route::get('', [
            'as'   => 'warranty.index',
            'uses' => 'WarrantyController@index',
        ]);

        Route::get('create', [
            'as'   => 'warranty.create',
            'uses' => 'WarrantyController@create',
        ]);

        Route::post('', [
            'as'   => 'warranty.store',
            'uses' => 'WarrantyController@store',
        ]);

        ROute::get('{id}', [
            'as'   => 'warranty.show',
            'uses' => 'WarrantyController@show'
        ]);

        Route::delete('{id}', [
            'as'   => 'warranty.destroy',
            'uses' => 'WarrantyController@destroy',
        ]);

        Route::get('search', [
            'as'   => 'warranty.search',
            'uses' => 'WarrantyController@search',
        ]);

    }
);
