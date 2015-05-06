<?php

namespace microchip\serviceData;

use microchip\base\BaseRepo;

class ServiceDataRepo extends BaseRepo
{
    public function getModel()
    {
        return new ServiceData();
    }

    public function newServiceData()
    {
        return $data = new ServiceData();
    }
}
