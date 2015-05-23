<?php

Route::get('report/corte', [
    'as'   => 'report.money',
    'uses' => 'ReportController@money',
]);