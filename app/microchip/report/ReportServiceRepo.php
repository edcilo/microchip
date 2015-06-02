<?php

namespace microchip\report;

use microchip\base\BaseRepo;

class ReportServiceRepo extends BaseRepo
{
    public function getModel()
    {
        return new ReportService();
    }

    public function newReport()
    {
        return $report = new ReportService();
    }
}