<?php

Route::group(['before' => 'pr:124'], function () {

    Route::get('report/corte', [
        'as'   => 'report.money',
        'uses'  => 'ReportController@index'
    ]);

    Route::group(['before' => 'pr:125'], function () {

        Route::get('report/corte/create', [
            'as'   => 'report.money.create',
            'uses' => 'ReportController@money',
        ]);

        Route::post('report/corte', [
            'as'    => 'report.money.store',
            'uses'  => 'ReportController@moneyStore'
        ]);

    });

    Route::group(['before' => 'pr:126'], function () {

        Route::get('report/corte/{report}/edit', [
            'as'    => 'report.money.edit',
            'uses'  => 'ReportController@edit'
        ]);

        Route::put('report/corte/{report}', [
            'as'    => 'report.money.update',
            'uses'  => 'ReportController@update'
        ]);

    });

    Route::get('report/corte/{report}', [
        'as'    => 'report.money.show',
        'uses'  => 'ReportController@show'
    ]);

});



Route::group(['before' => 'pr:127'], function () {

    Route::get('report/utilities', [
        'as'   => 'report.utility',
        'uses'  => 'ReportUtilityController@index'
    ]);

    Route::group(['before' => 'pr:128'], function () {

        Route::get('report/utilities/create', [
            'as'   => 'report.utility.create',
            'uses' => 'ReportUtilityController@create',
        ]);

        Route::post('report/utilities', [
            'as'    => 'report.utility.store',
            'uses'  => 'ReportUtilityController@store'
        ]);

    });

    Route::group(['before' => 'pr:129'], function () {

        Route::get('report/utilities/{report}/edit', [
            'as'    => 'report.utility.edit',
            'uses'  => 'ReportUtilityController@edit'
        ]);

        Route::put('report/utilities/{report}', [
            'as'    => 'report.utility.update',
            'uses'  => 'ReportUtilityController@update'
        ]);

    });

    Route::get('report/utilities/{report}', [
        'as'    => 'report.utility.show',
        'uses'  => 'ReportUtilityController@show'
    ]);

});


Route::group(['before' => 'pr:130'], function () {

    Route::get('report/services', [
        'as'    => 'report.service.index',
        'uses'  => 'ReportServiceController@index'
    ]);

    Route::group(['before' => 'pr:131'], function () {

        Route::get('report/service/create', [
            'as'    => 'report.service.create',
            'uses'  => 'ReportServiceController@create'
        ]);

        Route::post('report/service', [
            'as'    => 'report.service.store',
            'uses'  => 'ReportServiceController@store'
        ]);

    });

    Route::group(['before' => 'pr:132'], function () {

        Route::get('report/service/{report}/edit', [
            'as'    => 'report.service.edit',
            'uses'  => 'ReportServiceController@edit'
        ]);

        Route::put('report/service/{report}', [
            'as'    => 'report.service.update',
            'uses'  => 'ReportServiceController@update',
        ]);

    });

    Route::get('report/service/{report}', [
        'as'    => 'report.service.show',
        'uses'  => 'ReportServiceController@show',
    ]);

});



Route::group(['before' => 'pr:130'], function () {

    Route::get('report/stock', [
        'as'    => 'report.stock',
        'uses'  => 'ReportStockController@index',
    ]);

});