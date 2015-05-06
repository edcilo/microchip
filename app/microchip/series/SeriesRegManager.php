<?php

namespace microchip\series;

use microchip\base\BaseManager;

class SeriesRegManager extends BaseManager
{
    public function getRules()
    {
        return [

        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['generate']       = 0;
        $data['date_warranty']  = 0;
        $data['ns']             = strtoupper($data['ns']);

        return $data;
    }
}
