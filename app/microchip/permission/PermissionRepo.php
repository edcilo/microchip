<?php

namespace microchip\permission;

use microchip\base\BaseRepo;

class PermissionRepo extends BaseRepo
{
    public function getModel()
    {
        return new Permission();
    }

    public function getWithoutPermission($ids)
    {
        return Permission::where(function ($query) use ($ids) {
            foreach ($ids as $id) {
                $query->where('id', '!=', $id);
            }
        })->orderBy('name')->get();
    }

    public function search($terms, $request = '', $take = 10)
    {
        $q = Permission::where('name', 'like', "%$terms%")
            ->orwhere('description', 'like', "%$terms%");

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }
}
