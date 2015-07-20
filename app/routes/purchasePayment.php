<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'purchasePayment/',
        'before' => 'pr:61',
    ],
    function () {

        Route::get('create', [
            'as'   => 'purchasePayment.create',
            'uses' => 'PurchasePaymentController@create',
        ]);

        Route::post('', [
            'as'   => 'purchasePayment.store',
            'uses' => 'PurchasePaymentController@store',
        ]);

        Route::delete('{payment_id}', [
            'as'   => 'purchasePayment.delete',
            'uses' => 'PurchasePaymentController@delete'
        ]);

    }
);
