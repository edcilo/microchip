<?php

namespace microchip\report;

use microchip\base\BaseRepo;

class ReportCorteRepo extends BaseRepo{

    public function getModel()
    {
        return new ReportCorte();
    }

    public function newCorte()
    {
        return $corte = new ReportCorte();
    }

}