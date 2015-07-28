<?php

Route::get('support/', [
    'as' => 'support.index',
    'uses' => 'SupportController@index',
]);

Route::get('support/create', [
    'as' => 'support.create',
    'uses' => 'SupportController@create',
]);

Route::post('support/', [
    'as' => 'support.store',
    'uses' => 'SupportController@store',
]);

Route::get('support/{id}', [
    'as' => 'support.show',
    'uses' => 'SupportController@show',
]);

Route::get('support/{support_id}/series/{movement_id}', [
    'as' => 'support.series.create',
    'uses' => 'SupportController@seriesCreate'
]);

Route::delete('support/{id}', [
    'as' => 'support.destroy',
    'uses' => 'SupportController@destroy',
]);

Route::post('support/{id}/authorize', [
    'as' => 'support.authorize',
    'uses' => 'SupportController@authorize'
]);

Route::post('support/{id}/get_down', [
    'as' => 'support.get.down',
    'uses' => 'SupportController@getDown'
]);

Route::get('support/{id}/print', [
    'as' => 'support.print',
    'uses' => 'SupportController@generatePrint'
]);