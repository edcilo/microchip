<?php

namespace microchip\providerPhone;

use microchip\base\BaseRepo;

class ProviderPhoneRepo extends BaseRepo
{
    public function getModel()
    {
        return new ProviderPhone();
    }

    public function newPhone()
    {
        return $phone = new ProviderPhone();
    }
}
