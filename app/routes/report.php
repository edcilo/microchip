<?php

Route::get('report/corte', [
    'as'   => 'report.money',
    'uses'  => 'ReportController@index'
]);

Route::get('report/corte/create', [
    'as'   => 'report.money.create',
    'uses' => 'ReportController@money',
]);

Route::post('report/corte', [
    'as'    => 'report.money.store',
    'uses'  => 'ReportController@moneyStore'
]);

Route::get('report/corte/{report}/edit', [
    'as'    => 'report.money.edit',
    'uses'  => 'ReportController@edit'
]);

Route::put('report/corte/{report}', [
    'as'    => 'report.money.update',
    'uses'  => 'ReportController@update'
]);

Route::get('report/corte/{report}', [
    'as'    => 'report.money.show',
    'uses'  => 'ReportController@show'
]);