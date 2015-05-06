<?php

namespace microchip\purchasePayment;

use microchip\base\BaseRepo;

class PurchasePaymentRepo extends BaseRepo
{
    public function getModel()
    {
        return new PurchasePayment();
    }

    public function newPayment()
    {
        return $payment = new PurchasePayment();
    }
}
