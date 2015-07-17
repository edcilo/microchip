<?php

namespace microchip\report;

use microchip\base\BaseManager;

class ReportCorteRegManager extends BaseManager{

    public function getRules()
    {
        return [
            'date_init'         => 'required|date',
            'time_init'         => 'date_format:H:i',
            'date_end'          => 'date',
            'time_end'          => 'date_format:H:i',
            'quantity_1000'     => 'integer',
            'quantity_500'      => 'integer',
            'quantity_200'      => 'integer',
            'quantity_100'      => 'integer',
            'quantity_50'       => 'integer',
            'quantity_20'       => 'integer',
            'quantity_10'       => 'integer',
            'quantity_5'        => 'integer',
            'quantity_2'        => 'integer',
            'quantity_1'        => 'integer',
            'quantity_05'       => 'integer',
            'quantity_r_1000'   => 'integer',
            'quantity_r_500'    => 'integer',
            'quantity_r_200'    => 'integer',
            'quantity_r_100'    => 'integer',
            'quantity_r_50'     => 'integer',
            'quantity_r_20'     => 'integer',
            'quantity_r_10'     => 'integer',
            'quantity_r_5'      => 'integer',
            'quantity_r_2'      => 'integer',
            'quantity_r_1'      => 'integer',
            'quantity_r_05'     => 'integer',
        ];
    }

    public function prepareData($data)
    {
        if (empty($data['date_end'])) {
            $data['date_end'] = $data['date_init'];
        }

        return $data;
    }

}