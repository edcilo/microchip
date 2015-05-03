<?php

Route::group([
    'perfix'    => 'coupon'
], function ()
{

    Route::get('', [
        'as'   => 'coupon.index',
        'uses' => 'CouponController@index'
    ]);

    Route::get('print/{id}', [
        'as'    => 'coupon.print',
        'uses'  => 'CouponController@generatePrint'
    ]);

});