<?php


/*
 * Routes
 */

Route::group(
    [
        'prefix' => 'pay/',
    ],
    function () {

        Route::group(['before' => 'pr:75'], function () {

            Route::get('pending', [
                'as'   => 'pay.pending',
                'uses' => 'PayController@pending',
            ]);

        });

        Route::group(['before' => 'pr:71'], function () {

            Route::get('', [
                'as'   => 'pay.index',
                'uses' => 'PayController@index',
            ]);

        });

        Route::group(['before' => 'pr:72'], function () {

            Route::get('pay/out', [
                'as'   => 'pay.out',
                'uses' => 'PayController@out',
            ]);

            Route::post('out', [
                'as'   => 'pay.store.out',
                'uses' => 'PayController@storeOut',
            ]);

            Route::get('pay/in', [
                'as'   => 'pay.in',
                'uses' => 'PayController@in',
            ]);

            Route::post('in', [
                'as'   => 'pay.store.in',
                'uses' => 'PayController@storeIn',
            ]);

            Route::get('pay/out/sale', [
                'as'    => 'pay.out.sale',
                'uses'  => 'PayController@payOutSale',
            ]);

            Route::post('pay/out/sale', [
                'as'    => 'pay.out.sale.store',
                'uses'  => 'PayController@payOutSaleStore',
            ]);

            Route::get('create/{sale_id}', [
                'as'   => 'pay.create',
                'uses' => 'PayController@create',
            ]);

            Route::post('{sale_id}', [
                'as'   => 'pay.store',
                'uses' => 'PayController@store',
            ]);

            // dinero dado para mandados y que tengan un cambio pendiente
            Route::get('change/{id}', [
                'as'   => 'pay.change',
                'uses' => 'PayController@change',
            ]);

            Route::put('change/in/{id}', [
                'as'   => 'pay.change.in',
                'uses' => 'PayController@changeIn',
            ]);

            Route::get('free/{sale_id}', [
                'as'   => 'pay.free',
                'uses' => 'PayController@free',
            ]);

        });

        Route::get('repayment/{id}', [
            'as'   => 'pay.repayment',
            'uses'  => 'PayController@repayment',
        ]);

        Route::post('repayment/{id}/{method}', [
            'as'   => 'pay.repayment.store',
            'uses' => 'PayController@repaymentStore',
        ]);

        Route::get('repayment/{id}/document', [
            'as'   => 'pay.repayment.print',
            'uses' => 'PayController@printDocument',
        ]);

        Route::group(['before' => 'pr:73'], function () {

            Route::get('{id}/edit', [
                'as'   => 'pay.edit',
                'uses' => 'PayController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'pay.update',
                'uses' => 'PayController@update',
            ]);

            Route::get('{id}/edit/in', [
                'as'   => 'pay.edit.in',
                'uses' => 'PayController@editIn',
            ]);

            Route::put('{id}/in', [
                'as'   => 'pay.update.in',
                'uses' => 'PayController@updateIn',
            ]);

            Route::get('{id}/edit/out', [
                'as'   => 'pay.edit.out',
                'uses' => 'PayController@editOut',
            ]);

            Route::put('{id}/out', [
                'as'   => 'pay.update.out',
                'uses' => 'PayController@updateOut',
            ]);

        });

        Route::group(['before' => 'pr:74'], function () {

            Route::delete('{id}', [
                'as'   => 'pay.destroy',
                'uses' => 'PayController@destroy',
            ]);

        });

        Route::get('{id}/print', [
            'as'   => 'pay.print',
            'uses' => 'PayController@payPrint',
        ]);

    }
);
