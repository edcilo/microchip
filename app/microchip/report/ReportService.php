<?php
namespace microchip\report;

use microchip\base\BaseEntity;

class ReportService extends BaseEntity {
    //protected $dates = ['date_init'];

    protected $table = 'report_services';

	protected $fillable = [
        'date_init',
        'date_end',
    ];
}