<?php

namespace microchip\report;

use microchip\base\BaseEntity;

class ReportUtility extends BaseEntity {
    protected $table = 'report_utility';

	protected $fillable = [
        'date_init',
        'date_end',
    ];
}