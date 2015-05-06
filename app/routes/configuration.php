<?php


Route::group(
    [
        'prefix' => 'configuration/',
        'before' => 'pr:1',
    ],
    function () {

        Route::get('{id}', [
            'as'   => 'configuration.show',
            'uses' => 'ConfigurationController@show',
        ]);

        Route::group(['before' => 'pr:2'], function () {

            Route::get('{id}/edit', [
                'as'   => 'configuration.edit',
                'uses' => 'ConfigurationController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'configuration.update',
                'uses' => 'ConfigurationController@update',
            ]);

        });

    }
);
