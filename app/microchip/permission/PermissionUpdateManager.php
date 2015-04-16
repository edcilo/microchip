<?php namespace microchip\permission;

use microchip\base\BaseManager;

class PermissionUpdateManager extends BaseManager {

    public function getRules()
    {
        return [
            'name'          => 'required|unique:permissions,name,' . $this->entity->id,
            'description'   => 'required'
        ];
    }

    public function prepareData($data)
    {
        return $data;
    }

}