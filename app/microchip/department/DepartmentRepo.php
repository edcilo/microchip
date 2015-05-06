<?php

namespace microchip\department;

use microchip\base\BaseRepo;

class DepartmentRepo extends BaseRepo
{
    public function getModel()
    {
        return new Department();
    }

    public function newDepartment()
    {
        return $department = new Department();
    }

    public function search($terms, $request = '', $take = 10)
    {
        $q = Department::where('name', 'like', "%$terms%")
            ->orwhere('description', 'like', "%$terms%");

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }
}
