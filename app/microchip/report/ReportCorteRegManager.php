<?php

namespace microchip\report;

use microchip\base\BaseManager;

class ReportCorteRegManager extends BaseManager{

    public function getRules()
    {
        return [
            'date_init'         => 'required|date',
            'date_end'          => 'date',
            'quantity_1000'     => 'required|integer',
            'quantity_500'      => 'required|integer',
            'quantity_200'      => 'required|integer',
            'quantity_100'      => 'required|integer',
            'quantity_50'       => 'required|integer',
            'quantity_20'       => 'required|integer',
            'quantity_10'       => 'required|integer',
            'quantity_5'        => 'required|integer',
            'quantity_2'        => 'required|integer',
            'quantity_1'        => 'required|integer',
            'quantity_05'       => 'required|integer',
            'quantity_r_1000'   => 'required|integer',
            'quantity_r_500'    => 'required|integer',
            'quantity_r_200'    => 'required|integer',
            'quantity_r_100'    => 'required|integer',
            'quantity_r_50'     => 'required|integer',
            'quantity_r_20'     => 'required|integer',
            'quantity_r_10'     => 'required|integer',
            'quantity_r_5'      => 'required|integer',
            'quantity_r_2'      => 'required|integer',
            'quantity_r_1'      => 'required|integer',
            'quantity_r_05'     => 'required|integer',
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