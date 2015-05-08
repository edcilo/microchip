<?php

namespace microchip\warranty;

use microchip\base\BaseRepo;

class WarrantyRepo extends BaseRepo
{
    public function getModel()
    {
        return new Warranty();
    }

    public function newWarranty()
    {
        return $warranty = new Warranty();
    }

    public function search($terms, $request = '', $take = 10)
    {
        $q = Warranty::where('id', $terms)
            ->orwhere('description', 'like', "%$terms%");

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }
}
