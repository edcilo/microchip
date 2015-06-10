<?php

namespace microchip\productDescription;

use microchip\base\BaseRepo;

class ProductDescriptionRepo extends BaseRepo
{
    public function getModel()
    {
        return new ProductDescription();
    }

    public function newDescription(array $data = array())
    {
        return $description = new ProductDescription($data);
    }
}
