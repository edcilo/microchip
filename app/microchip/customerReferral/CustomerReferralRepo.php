<?php

namespace microchip\customerReferral;

use microchip\base\BaseRepo;

class CustomerReferralRepo extends BaseRepo
{
    public function getModel()
    {
        return new CustomerReferral();
    }

    public function newReferred()
    {
        return $referral = new CustomerReferral();
    }
}
