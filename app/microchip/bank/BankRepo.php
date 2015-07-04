<?php

namespace microchip\bank;

use microchip\base\BaseRepo;

class BankRepo extends BaseRepo
{
    public function getModel()
    {
        return new Bank();
    }

    public function newBank()
    {
        return $bank = new Bank();
    }

    public function lists_active($column, $key = null, $order_column = 'id', $order='asc')
    {
        $q = Bank::where('active', 1)
            ->orderBy($order_column, $order);

        return (is_null($key)) ? $q->lists($column) : $q->lists($column, $key);
    }

    public function search($terms, $response = '', $take = 10)
    {
        $q = Bank::where('name', 'LIKE', "%$terms%")
            ->orwhere('branch', 'LIKE', "%$terms%")
            ->orwhere('executive_name', 'LIKE', "%$terms%")
            ->orwhere('country', 'LIKE', "%$terms%")
            ->orwhere('state', 'LIKE', "%$terms%")
            ->orwhere('city', 'LIKE', "%$terms%")
            ->orwhere('colony', 'LIKE', "%$terms%")
            ->orwhere('address', 'LIKE', "%$terms%");

        return ($response == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }
}
