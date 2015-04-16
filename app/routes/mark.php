<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'mark/',
        'before' => 'pr:41'
    ],
    function ()
    {

        Route::get('', [
            'as'   => 'mark.index',
            'uses' => 'MarkController@index'
        ]);

        Route::group(['before' => 'pr:42'], function () {

            Route::get('create', [
                'as'   => 'mark.create',
                'uses' => 'MarkController@create'
            ]);

            Route::post('', [
                'as'   => 'mark.store',
                'uses' => 'MarkController@store'
            ]);

        });

        Route::group(['before' => 'pr:43'], function () {

            Route::get('{slug}/{id}/edit', [
                'as'   => 'mark.edit',
                'uses' => 'MarkController@edit'
            ]);

            Route::put('{id}', [
                'as'   => 'mark.update',
                'uses' => 'MarkController@update'
            ]);

        });

        Route::group(['before' => 'pr:44'], function () {

            Route::delete('{id}', [
                'as'   => 'mark.destroy',
                'uses' => 'MarkController@destroy'
            ]);

        });

        Route::get('{slug}/{id}', [
            'as'   => 'mark.show',
            'uses' => 'MarkController@show'
        ]);

        Route::get('search', [
            'as'   => 'mark.search',
            'uses' => 'MarkController@search'
        ]);

    }
);
