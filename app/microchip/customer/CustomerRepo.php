<?php

namespace microchip\customer;

use microchip\base\BaseRepo;

class CustomerRepo extends BaseRepo
{
    public function getModel()
    {
        return new Customer();
    }

    public function newCustomer()
    {
        return $customer = new Customer();
    }

    public function search($terms, $request = '', $active=null, $take = 10)
    {
        $q = Customer::orderBy('name');

        if (!is_null($active)) {
            $q->where('active', $active);
        }

        $q->where(function ($query) use ($terms) {
            $query->where('name', 'like', "%$terms%")
                ->orwhere('phone', 'like', "%$terms%")
                ->orwhere('cellphone', 'like', "%$terms%")
                ->orwhere('email', 'like', "%$terms%")
                ->orwhere('rfc', 'like', "%$terms%")
                ->orwhere('card_id', 'like', "%$terms%");
        });

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }

    public function getByCard($card_id)
    {
        return Customer::where('card_id', $card_id)->first();
    }
}
