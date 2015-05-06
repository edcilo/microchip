<?php

Route::group(
    [
        'prefix' => 'cheque/',
        'before' => 'pr:11',
    ],
    function () {

        Route::group(['before' => 'pr:12'], function () {

            Route::get('create/{bank_id}', [
                'as'   => 'cheque.create',
                'uses' => 'ChequeController@create',
            ]);

            Route::post('', [
                'as'   => 'cheque.store',
                'uses' => 'ChequeController@store',
            ]);

        });

        Route::group(['before' => 'pr:13'], function () {

            Route::get('{slug}/{id}/edit', [
                'as'   => 'cheque.edit',
                'uses' => 'ChequeController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'cheque.update',
                'uses' => 'ChequeController@update',
            ]);

        });

        Route::group(['before' => 'pr:14'], function () {

            Route::get('soft/delete/{id}', [
                'as'   => 'cheque.soft.delete',
                'uses' => 'ChequeController@softDelete',
            ]);

        });

        Route::group(['before' => 'pr:15'], function () {

            Route::get('restore/{id}', [
                'as'   => 'cheque.restore',
                'uses' => 'ChequeController@restore',
            ]);

        });

        Route::get('filter', [
            'as'   => 'cheque.filter',
            'uses' => 'ChequeController@filter',
        ]);

        Route::get('{slug}/{id}', [
            'as'   => 'cheque.show',
            'uses' => 'ChequeController@show',
        ]);

        // registrar movimiento de salida de la cuenta bancaria
        Route::post('generate/count/{id}', [
            'as'   => 'cheque.count',
            'uses' => 'ChequeController@generateBankCount',
        ]);

    }
);
