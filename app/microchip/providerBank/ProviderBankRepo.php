<?php namespace microchip\providerBank;

use microchip\base\BaseRepo;

class ProviderBankRepo extends BaseRepo {

    public function getModel()
    {
        return new ProviderBank();
    }

    public function newBank()
    {
        return $bank = new ProviderBank();
    }

}