<?php

Route::group(
    [
        'prefix' => 'contactCustomer/',
        'before' => 'pr:65'
    ],
    function ()
    {
        Route::post('store/{id}', [
            'as'   => 'customer.contact.store',
            'uses' => 'CustomerContactController@store'
        ]);

        Route::delete('destroy/{id}', [
            'as' => 'customer.contact.destroy',
            'uses' => 'CustomerContactController@destroy'
        ]);

    }
);