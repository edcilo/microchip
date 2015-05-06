<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'providerContact/',
    ],
    function () {

        Route::get('', [
            'as'   => 'providerContact.index',
            'uses' => 'ProviderContactController@index',
        ]);

        Route::get('create/{provider_id}', [
            'as'   => 'providerContact.create',
            'uses' => 'ProviderContactController@create',
        ]);

        Route::post('', [
            'as'   => 'providerContact.store',
            'uses' => 'ProviderContactController@store',
        ]);

        Route::get('{id}/{provider_id}/edit', [
            'as'   => 'providerContact.edit',
            'uses' => 'ProviderContactController@edit',
        ]);

        Route::put('{id}', [
            'as'   => 'providerContact.update',
            'uses' => 'ProviderContactController@update',
        ]);

        Route::delete('{id}', [
            'as'   => 'providerContact.destroy',
            'uses' => 'ProviderContactController@destroy',
        ]);

    }
);
