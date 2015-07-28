<?php

namespace microchip\support;

use microchip\base\BaseRepo;

class SupportRepo extends BaseRepo
{
    public function getModel()
    {
        return new Support();
    }

    public function newSupport()
    {
        return $support = new Support();
    }

    public function filter($status)
    {
        return Support::where('status', $status)->paginate(10);
    }

    public function search($terms, $request='', $take=10)
    {
        $q = Support::select('support.id', 'support.status', 'products.barcode', 'products.s_description')
            ->leftJoin('products', 'support.product_id', '=', 'products.id')
            ->where('status', 'like', "%$terms%")
            ->orWhere('barcode', 'like', "%$terms%")
            ->orWhere('s_description', 'like', "%$terms%");

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }
}