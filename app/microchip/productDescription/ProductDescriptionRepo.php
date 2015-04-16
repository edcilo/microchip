<?php namespace microchip\productDescription;

use microchip\base\BaseRepo;

class ProductDescriptionRepo extends BaseRepo {

    public function getModel()
    {
        return new ProductDescription();
    }

    public function newDescription()
    {
        return $description = new ProductDescription();
    }

}