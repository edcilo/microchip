<?php

namespace microchip\company;

use microchip\base\BaseRepo;

class CompanyRepo extends BaseRepo
{
    public function getModel()
    {
        return new Company();
    }

    public function newCompany()
    {
        return $company = new Company();
    }
}
