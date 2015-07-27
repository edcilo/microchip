<?php

namespace microchip\support;

use microchip\base\BaseRepo;

class SupportRepo extends BaseRepo
{
    public function getModel()
    {
        return new Support();
    }

    public function newSupport()
    {
        return $support = new Support();
    }
}