<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'bank/',
        'before' => 'pr:5',
    ],
    function () {

        Route::get('', [
            'as'   => 'bank.index',
            'uses' => 'BankController@index',
        ]);

        Route::group(['before' => 'pr:6'], function () {

            Route::get('create', [
                'as'   => 'bank.create',
                'uses' => 'BankController@create',
            ]);

            Route::post('', [
                'as'   => 'bank.store',
                'uses' => 'BankController@store',
            ]);

        });

        Route::group(['before' => 'pr:7'], function () {

            Route::get('{slug}/{id}/edit', [
                'as'   => 'bank.edit',
                'uses' => 'BankController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'bank.update',
                'uses' => 'BankController@update',
            ]);

        });

        Route::group(['before' => 'pr:8'], function () {

            Route::get('soft/delete/{id}', [
                'as'   => 'bank.soft.delete',
                'uses' => 'BankController@softDelete',
            ]);

        });

        Route::group(['before' => 'pr:9'], function () {

            Route::get('restore/{id}', [
                'as'   => 'bank.restore',
                'uses' => 'BankController@restore',
            ]);

        });

        Route::group(['before' => 'pr:10'], function () {

            Route::delete('{id}', [
                'as'   => 'bank.destroy',
                'uses' => 'BankController@destroy',
            ]);

        });

        Route::get('trash', [
            'as'   => 'bank.trash',
            'uses' => 'BankController@trash',
        ]);

        Route::get('search', [
            'as'   => 'bank.search',
            'uses' => 'BankController@search',
        ]);

        Route::get('{slug}/{id}/{cheques}', [
            'as'   => 'bank.show',
            'uses' => 'BankController@show',
        ]);

    }
);
