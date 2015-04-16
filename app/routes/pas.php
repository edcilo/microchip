<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'pas/'
    ],
    function ()
    {

        Route::get('', [
            'as'   => 'pas.index',
            'uses' => 'PendingMovementsController@index'
        ]);

        Route::get('create/{id}', [
            'as'   => 'pas.create',
            'uses' => 'PendingMovementsController@create'
        ]);

        Route::group(['before' => 'pr:86,95'], function () {

            Route::post('order', [
                'as'   => 'pas.order.store',
                'uses' => 'PendingMovementsController@orderStore'
            ]);

        });

        Route::post('', [
            'as'   => 'pas.store',
            'uses' => 'PendingMovementsController@store'
        ]);

        Route::get('{id}/edit', [
            'as'   => 'pas.edit',
            'uses' => 'PendingMovementsController@edit'
        ]);

        Route::put('{id}', [
            'as'   => 'pas.update',
            'uses' => 'PendingMovementsController@update'
        ]);

        Route::get('{id}', [
            'as'   => 'pas.show',
            'uses' => 'PendingMovementsController@show'
        ]);

        Route::delete('{id}', [
            'as'   => 'pas.destroy',
            'uses' => 'PendingMovementsController@destroy'
        ]);

        Route::get('search', [
            'as'   => 'pas.search',
            'uses' => 'PendingMovementsController@search'
        ]);

        Route::post('to/movement/{id}', [
            'as'   => 'pas.to.movement',
            'uses' => 'PendingMovementsController@toMovement'
        ]);

    }
);