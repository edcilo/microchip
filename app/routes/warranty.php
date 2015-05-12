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

        Route::get('{id}', [
            'as'   => 'warranty.show',
            'uses' => 'WarrantyController@show'
        ]);

        Route::delete('{id}', [
            'as'   => 'warranty.destroy',
            'uses' => 'WarrantyController@destroy',
        ]);

        Route::put('{id}/solution', [
            'as'    => 'warranty.save.solution',
            'uses'  => 'WarrantyController@storeSolution'
        ]);

        Route::get('search', [
            'as'   => 'warranty.search',
            'uses' => 'WarrantyController@search',
        ]);

        Route::post('status/send/{id}', [
            'as'   => 'warranty.send',
            'uses' => 'WarrantyController@send'
        ]);

        Route::get('print/{id}', [
            'as'   => 'warranty.print',
            'uses' => 'WarrantyController@generatePrint'
        ]);

    }
);
