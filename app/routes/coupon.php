<?php

Route::group(
    [
        'prefix' => 'coupon/',
        'before' => 'pr:115',
    ],
    function () {

        Route::get('', [
            'as'   => 'coupon.index',
            'uses' => 'CouponController@index',
        ]);

        Route::get('print/{id}', [
            'as'    => 'coupon.print',
            'uses'  => 'CouponController@generatePrint',
        ]);

        Route::group(['before' => 'pr:117'], function () {

            Route::post('store/{sale}', [
                'as' => 'coupon.store',
                'uses' => 'CouponController@store'
            ]);

        });

        Route::get('search', [
            'as'   => 'coupon.search',
            'uses' => 'CouponController@search',
        ]);

        Route::get('{folio}/{id}', [
            'as'   => 'coupon.show',
            'uses' => 'CouponController@show',
        ]);

        Route::group(['before' => 'pr:116'], function () {

            Route::delete('{id}', [
                'as'   => 'coupon.destroy',
                'uses' => 'CouponController@destroy',
            ]);

        });

});

Route::get('api/coupon/get', [
    'as' => 'api.coupon.search',
    'uses' => 'CouponController@get',
]);