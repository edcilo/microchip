<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'referrer/',
    ],
    function ()
    {

        Route::group(['before' => 'pr:69'], function () {

            Route::put('{id}', [
                'as'   => 'referrer.update',
                'uses' => 'CustomerReferrerController@update'
            ]);

        });

        Route::group(['before' => 'pr:70'], function () {

            Route::delete('{id}', [
                'as'   => 'referrer.destroy',
                'uses' => 'CustomerReferrerController@destroy'
            ]);

        });

    }
);
