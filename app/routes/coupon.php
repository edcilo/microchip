<?php

Route::get('coupon/print/{id}', [
    'as'    => 'coupon.print',
    'uses'  => 'CouponController@generatePrint'
]);