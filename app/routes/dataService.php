<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'serviceData/',
        'before' => 'pr:94,95,96'
    ],
    function ()
    {

        Route::post('{sale_id}', [
            'as'   => 'service.data.store',
            'uses' => 'ServiceDataController@store'
        ]);

        Route::get('{slug}/{id}/edit', [
            'as'   => 'service.data.edit',
            'uses' => 'ServiceDataController@edit'
        ]);

        Route::put('{id}', [
            'as'   => 'service.data.update',
            'uses' => 'ServiceDataController@update'
        ]);

        Route::delete('{id}', [
            'as'   => 'service.data.destroy',
            'uses' => 'ServiceDataController@destroy'
        ]);

    }
);
