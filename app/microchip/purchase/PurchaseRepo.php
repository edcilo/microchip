<?php

namespace microchip\purchase;

use microchip\base\BaseRepo;

class PurchaseRepo extends BaseRepo
{
    public function getModel()
    {
        return new Purchase();
    }

    public function newPurchase()
    {
        return $purchase = new Purchase();
    }

    public function uniqueFolio($provider_id, $folio)
    {
        return Purchase::where('provider_id', $provider_id)
            ->where('folio', $folio)
            ->get();
    }

    public function getIncomplete($like = 'all', $column = 'id', $order = 'ASC')
    {
        $q = Purchase::where('progress_1', 0)
            ->orwhere('progress_2', 0)
            ->orwhere('progress_3', 0)
            ->orwhere('progress_4', 1)
            ->orderby($column, $order);

        return ($like == 'all') ? $q->get() : $q->paginate();
    }

    public function search($terms, $request = '', $take = 10)
    {
        $q = Purchase::where('folio', 'like', "%$terms%");

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }
}
