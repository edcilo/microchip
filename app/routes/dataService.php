<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'serviceData/'
    ],
    function ()
    {

        Route::post('{sale_id}', [
            'as'   => 'service.data.store',
            'uses' => 'serviceDataController@store'
        ]);

        Route::get('{slug}/{id}/edit', [
            'as'   => 'service.data.edit',
            'uses' => 'serviceDataController@edit'
        ]);

        Route::put('{id}', [
            'as'   => 'service.data.update',
            'uses' => 'serviceDataController@update'
        ]);

        Route::delete('{id}', [
            'as'   => 'service.data.destroy',
            'uses' => 'serviceDataController@destroy'
        ]);

    }
);
