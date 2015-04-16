<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'bankCount/',
        'before' => 'pr:16'
    ],
    function ()
    {

        Route::get('{bank_id}', [
            'as'   => 'bankCount.index',
            'uses' => 'BankCountController@index'
        ]);

        Route::group(['before' => 'pr:17'], function () {

            Route::get('create/{bank_id}', [
                'as'   => 'bankCount.create',
                'uses' => 'BankCountController@create'
            ]);

            Route::post('{bank_id}', [
                'as'   => 'bankCount.store',
                'uses' => 'BankCountController@store'
            ]);

        });

        Route::group(['before' => 'pr:18'], function () {

            Route::get('{id}/edit', [
                'as'   => 'bankCount.edit',
                'uses' => 'BankCountController@edit'
            ]);

            Route::put('{id}', [
                'as'   => 'bankCount.update',
                'uses' => 'BankCountController@update'
            ]);

        });

        Route::group(['before' => 'pr:19'], function () {

            Route::delete('{id}', [
                'as'   => 'bankCount.destroy',
                'uses' => 'BankCountController@destroy'
            ]);

        });

    }
);
