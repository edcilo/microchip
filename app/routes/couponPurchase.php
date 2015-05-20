<?php

Route::group(
    [
        'prefix' => 'credits/',
        'before' => 'pr:118',
    ],
    function () {

        Route::get('', [
            'as'   => 'coupon.purchase.index',
            'uses' => 'CouponPurchaseController@index',
        ]);

        Route::get('search', [
            'as'   => 'coupon.purchase.search',
            'uses' => 'CouponPurchaseController@search',
        ]);

        Route::get('{id}', [
            'as'   => 'coupon.purchase.show',
            'uses' => 'CouponPurchaseController@show',
        ]);

    }
);
