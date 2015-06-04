<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'concept/',
        'before' => 'pr:134',
    ],
    function () {

        Route::get('', [
            'as'   => 'concept.index',
            'uses' => 'PaymentConceptController@index',
        ]);

        Route::group(['before' => 'pr:135'], function () {

            Route::get('create', [
                'as'   => 'concept.create',
                'uses' => 'PaymentConceptController@create',
            ]);

            Route::post('', [
                'as'   => 'concept.store',
                'uses' => 'PaymentConceptController@store',
            ]);

        });

        Route::group(['before' => 'pr:136'], function () {

            Route::get('{id}/edit', [
                'as'   => 'concept.edit',
                'uses' => 'PaymentConceptController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'concept.update',
                'uses' => 'PaymentConceptController@update',
            ]);

        });

        Route::group(['before' => 'pr:137'], function () {

            Route::delete('{id}', [
                'as'   => 'concept.destroy',
                'uses' => 'PaymentConceptController@destroy',
            ]);

        });

        Route::get('search', [
            'as'   => 'concept.search',
            'uses' => 'PaymentConceptController@search',
        ]);

    }
);
