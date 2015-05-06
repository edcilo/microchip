<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'department/',
        'before' => 'pr:20',
    ],
    function () {

        Route::get('', [
            'as'   => 'department.index',
            'uses' => 'DepartmentController@index',
        ]);

        Route::group(['before' => 'pr:21'], function () {

            Route::get('create', [
                'as'   => 'department.create',
                'uses' => 'DepartmentController@create',
            ]);

            Route::post('', [
                'as'   => 'department.store',
                'uses' => 'DepartmentController@store',
            ]);

        });

        Route::group(['before' => 'pr:22'], function () {

            Route::get('{slug}/{id}/edit', [
                'as'   => 'department.edit',
                'uses' => 'DepartmentController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'department.update',
                'uses' => 'DepartmentController@update',
            ]);

        });

        Route::group(['before' => 'pr:23'], function () {

            Route::delete('{id}', [
                'as'   => 'department.destroy',
                'uses' => 'DepartmentController@destroy',
            ]);

        });

        Route::get('{slug}/{id}', [
            'as'   => 'department.show',
            'uses' => 'DepartmentController@show',
        ]);

        Route::get('search', [
            'as'   => 'department.search',
            'uses' => 'DepartmentController@search',
        ]);

    }
);
