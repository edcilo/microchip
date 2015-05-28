<?php

namespace microchip\report;

use microchip\base\BaseEntity;

class ReportCorte extends BaseEntity {
    protected $table = 'report_corte';

	protected $fillable = [
        'date_init',
        'date_end',
        'quantity_1000',
        'quantity_500',
        'quantity_200',
        'quantity_100',
        'quantity_50',
        'quantity_20',
        'quantity_10',
        'quantity_5',
        'quantity_2',
        'quantity_1',
        'quantity_05',
        'quantity_r_1000',
        'quantity_r_500',
        'quantity_r_200',
        'quantity_r_100',
        'quantity_r_50',
        'quantity_r_20',
        'quantity_r_10',
        'quantity_r_5',
        'quantity_r_2',
        'quantity_r_1',
        'quantity_r_05',
    ];
}