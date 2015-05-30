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



Route::get('report/utilidades', [
    'as'   => 'report.utility',
    'uses'  => 'ReportUtilityController@index'
]);

Route::get('report/utilidades/create', [
    'as'   => 'report.utility.create',
    'uses' => 'ReportUtilityController@create',
]);

Route::post('report/utilidades', [
    'as'    => 'report.utility.store',
    'uses'  => 'ReportUtilityController@store'
]);

Route::get('report/utilidades/{report}', [
    'as'    => 'report.utility.show',
    'uses'  => 'ReportUtilityController@show'
]);

Route::get('report/utilidades/{report}/edit', [
    'as'    => 'report.utility.edit',
    'uses'  => 'ReportUtilityController@edit'
]);

Route::put('report/utilidades/{report}', [
    'as'    => 'report.utility.update',
    'uses'  => 'ReportUtilityController@update'
]);