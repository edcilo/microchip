<?php

namespace microchip\paymentConcept;

use microchip\base\BaseRepo;

class PaymentConceptRepo extends BaseRepo
{
    public function getModel()
    {
        return new PaymentConcept();
    }

    public function newConcept()
    {
        return $concept = new PaymentConcept();
    }

    public function search($terms, $request = '', $take = 10)
    {
        $q = PaymentConcept::where('concept', 'like', "%$terms%");

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }
}