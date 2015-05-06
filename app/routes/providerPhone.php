<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'providerPhone/',
    ],
    function () {

        Route::get('', [
            'as'   => 'providerPhone.index',
            'uses' => 'ProviderPhoneController@index',
        ]);

        Route::get('create/{provider_id}', [
            'as'   => 'providerPhone.create',
            'uses' => 'ProviderPhoneController@create',
        ]);

        Route::post('', [
            'as'   => 'providerPhone.store',
            'uses' => 'ProviderPhoneController@store',
        ]);

        Route::get('{id}/{provider_id}/edit', [
            'as'   => 'providerPhone.edit',
            'uses' => 'ProviderPhoneController@edit',
        ]);

        Route::put('{id}', [
            'as'   => 'providerPhone.update',
            'uses' => 'ProviderPhoneController@update',
        ]);

        Route::delete('{id}', [
            'as'   => 'providerPhone.destroy',
            'uses' => 'ProviderPhoneController@destroy',
        ]);

    }
);
