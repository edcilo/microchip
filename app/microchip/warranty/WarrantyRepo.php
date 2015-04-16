<?php namespace microchip\warranty;

use microchip\base\BaseRepo;

class WarrantyRepo extends BaseRepo {

    public function getModel()
    {
        return new Warranty();
    }

    public function newWarranty()
    {
        return $warranty = new Warranty();
    }

}