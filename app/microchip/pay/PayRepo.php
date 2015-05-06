<?php

namespace microchip\pay;

use microchip\base\BaseRepo;

class PayRepo extends BaseRepo
{
    public function getModel()
    {
        return new Pay();
    }

    public function newPay()
    {
        return $pay = new Pay();
    }

    public function getByMethod($method)
    {
        return Pay::where('method', $method)
            ->orderBy('created_at')
            ->get();
    }

    public function getCreditCard()
    {
        return Pay::where('method', 'Tarjeta de crédito/débito')
            ->get();
    }

    public function getPending()
    {
        return Pay::where('change_check', 1)->paginate();
    }
}
