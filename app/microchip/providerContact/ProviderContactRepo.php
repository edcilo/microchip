<?php namespace microchip\providerContact;

use microchip\base\BaseRepo;

class ProviderContactRepo extends BaseRepo {

    public function getModel()
    {
        return new ProviderContact();
    }

    public function newContact()
    {
        return $contact = new ProviderContact();
    }

}