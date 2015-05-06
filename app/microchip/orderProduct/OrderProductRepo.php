<?php

namespace microchip\orderProduct;

use microchip\base\BaseRepo;

class OrderProductRepo extends BaseRepo
{
    public function getModel()
    {
        return new OrderProduct();
    }

    public function newOrderProduct()
    {
        return $order_product = new OrderProduct();
    }
}
