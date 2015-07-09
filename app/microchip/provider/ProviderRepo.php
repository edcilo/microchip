<?php

namespace microchip\provider;

use microchip\base\BaseRepo;

class ProviderRepo extends BaseRepo
{
    public function getModel()
    {
        return new Provider();
    }

    public function newProvider()
    {
        return $provider = new Provider();
    }

    public function search($terms, $request = '', $take = 10)
    {
        $q = Provider::where('name', 'like', "%$terms%")
            ->orwhere('rfc', 'like', "%$terms%")
            ->orwhere('email', 'like', "%$terms%")
            ->orwhere('classification', 'like', "%$terms%")
            ->orwhere('observations', 'like', "%$terms%");

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }

    public function findByName($name)
    {
        return Provider::where('name', $name)->first();
    }
}
