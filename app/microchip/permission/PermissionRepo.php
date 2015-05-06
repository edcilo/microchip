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
}
