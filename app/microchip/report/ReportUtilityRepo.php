<?php

namespace microchip\report;

use microchip\base\BaseRepo;

class ReportUtilityRepo extends BaseRepo {

    public function getModel()
    {
        return new ReportUtility();
    }

    public function newRepor()
    {
        return $report = new ReportUtility();
    }

}