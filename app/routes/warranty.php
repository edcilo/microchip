<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'warranty/'
    ],
    function ()
    {

        Route::get('', [
            'as'   => 'warranty.index',
            'uses' => 'WarrantyController@index'
        ]);

        Route::get('create', [
            'as'   => 'warranty.create',
            'uses' => 'WarrantyController@create'
        ]);

        Route::post('{movement_id}', [
            'as'   => 'warranty.store',
            'uses' => 'WarrantyController@store'
        ]);

        Route::get('{slug}/{id}', [
            'as'   => 'warranty.show',
            'uses' => 'WarrantyController@show'
        ]);

        Route::get('{slug}/{id}/edit', [
            'as'   => 'warranty.edit',
            'uses' => 'WarrantyController@edit'
        ]);

        Route::put('{id}', [
            'as'   => 'warranty.update',
            'uses' => 'WarrantyController@update'
        ]);

        Route::delete('{id}', [
            'as'   => 'warranty.destroy',
            'uses' => 'WarrantyController@destroy'
        ]);

        Route::get('search', [
            'as'   => 'warranty.search',
            'uses' => 'WarrantyController@search'
        ]);

    }
);
