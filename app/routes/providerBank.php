<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'providerBank/'
    ],
    function ()
    {

        Route::get('', [
            'as'   => 'providerBank.index',
            'uses' => 'ProviderBankController@index'
        ]);

        Route::get('create/{provider_id}', [
            'as'   => 'providerBank.create',
            'uses' => 'ProviderBankController@create'
        ]);

        Route::post('', [
            'as'   => 'providerBank.store',
            'uses' => 'ProviderBankController@store'
        ]);

        Route::get('{id}/{provider_id}/edit', [
            'as'   => 'providerBank.edit',
            'uses' => 'ProviderBankController@edit'
        ]);

        Route::put('{id}', [
            'as'   => 'providerBank.update',
            'uses' => 'ProviderBankController@update'
        ]);

        Route::delete('{id}', [
            'as'   => 'providerBank.destroy',
            'uses' => 'ProviderBankController@destroy'
        ]);

    }
);
