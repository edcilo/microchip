<?php

namespace microchip\customerContact;

use microchip\bank\BankRepo;

class CustomerContactRepo extends BankRepo
{
    public function getModel()
    {
        return new CustomerContact();
    }

    public function newContact()
    {
        return $contact = new CustomerContact();
    }
}
