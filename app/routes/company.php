<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'company/',
        'before' => 'pr:3'
    ],
    function ()
    {

        Route::group(['before' => 'pr:4'], function ()
        {

            Route::get('create', [
                'as'   => 'company.create',
                'uses' => 'CompanyController@create'
            ]);

            Route::post('', [
                'as'   => 'company.store',
                'uses' => 'CompanyController@store'
            ]);

            Route::get('{id}/edit', [
                'as'   => 'company.edit',
                'uses' => 'CompanyController@edit'
            ]);

            Route::put('{id}', [
                'as'   => 'company.update',
                'uses' => 'CompanyController@update'
            ]);

        });

        Route::get('{id}' , [
            'as'   => 'company.show',
            'uses' => 'CompanyController@show'
        ]);

    }
);
