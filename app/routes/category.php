<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'category/',
        'before' => 'pr:45',
    ],
    function () {

        Route::get('', [
            'as'   => 'category.index',
            'uses' => 'CategoryController@index',
        ]);

        Route::group(['before' => 'pr:46'], function () {

            Route::get('create', [
                'as'   => 'category.create',
                'uses' => 'CategoryController@create',
            ]);

            Route::post('', [
                'as'   => 'category.store',
                'uses' => 'CategoryController@store',
            ]);

        });

        Route::group(['before' => 'pr:47'], function () {

            Route::get('{slug}/{id}/edit', [
                'as'   => 'category.edit',
                'uses' => 'CategoryController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'category.update',
                'uses' => 'CategoryController@update',
            ]);

        });

        Route::group(['before' => 'pr:48'], function () {

            Route::delete('{id}', [
                'as'   => 'category.destroy',
                'uses' => 'CategoryController@destroy',
            ]);

        });

        Route::get('{slug}/{id}', [
            'as'   => 'category.show',
            'uses' => 'CategoryController@show',
        ]);

        Route::get('search', [
            'as'   => 'category.search',
            'uses' => 'CategoryController@search',
        ]);

    }
);
