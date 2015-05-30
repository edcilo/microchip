<?php

namespace microchip\report;

use Carbon\Carbon;
use microchip\base\BaseManager;

class ReportUtilityRegManager extends BaseManager {

    public function getRules()
    {
        return [
            'date_init' => 'required|date',
            'date_end'  => 'date'
        ];
    }

    public function prepareData($data)
    {
        if (empty($data['date_end'])) {
            $data['date_end'] = Carbon::createFromFormat('Y-m-d', $data['date_init'])->addDay()->format('Y-m-d');
        }

        return $data;
    }

}