<?php

Route::group(
    [
        'prefix' => 'coupon/',
        'before' => 'pr:115',
    ],
    function ()
    {

        Route::get('', [
            'as'   => 'coupon.index',
            'uses' => 'CouponController@index'
        ]);

        Route::get('print/{id}', [
            'as'    => 'coupon.print',
            'uses'  => 'CouponController@generatePrint'
        ]);

        Route::group(['before' => 'pr:116'], function () {

            Route::delete('{id}', [
                'as'   => 'coupon.destroy',
                'uses' => 'CouponController@destroy'
            ]);

        });

});