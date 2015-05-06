<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'provider/',
        'before' => 'pr:35',
    ],
    function () {

        Route::get('', [
            'as'   => 'provider.index',
            'uses' => 'ProviderController@index',
        ]);

        Route::group(['before' => 'pr:36'], function () {

            Route::get('create', [
                'as'   => 'provider.create',
                'uses' => 'ProviderController@create',
            ]);

            Route::post('', [
                'as'   => 'provider.store',
                'uses' => 'ProviderController@store',
            ]);

        });

        Route::group(['before' => 'pr:37'], function () {

            Route::get('{slug}/{id}/edit', [
                'as'   => 'provider.edit',
                'uses' => 'ProviderController@edit',
            ]);

            Route::put('{id}', [
                'as'   => 'provider.update',
                'uses' => 'ProviderController@update',
            ]);

        });

        Route::group(['before' => 'pr:38'], function () {

            Route::get('soft/delete/{id}', [
                'as'   => 'provider.soft.delete',
                'uses' => 'ProviderController@softDelete',
            ]);

        });

        Route::group(['before' => 'pr:39'], function () {

            Route::get('restore/{id}', [
                'as'   => 'provider.restore',
                'uses' => 'ProviderController@restore',
            ]);

        });

        Route::group(['before' => 'pr:40'], function () {

            Route::delete('{id}', [
                'as'   => 'provider.destroy',
                'uses' => 'ProviderController@destroy',
            ]);

        });

        Route::get('trash', [
            'as'   => 'provider.trash',
            'uses' => 'ProviderController@trash',
        ]);

        Route::get('search', [
            'as'   => 'provider.search',
            'uses' => 'ProviderController@search',
        ]);

        Route::get('{slug}/{id}', [
            'as'   => 'provider.show',
            'uses' => 'ProviderController@show',
        ]);

    }
);
