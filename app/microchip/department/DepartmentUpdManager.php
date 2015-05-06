<?php

namespace microchip\department;

use microchip\base\BaseManager;

class DepartmentUpdManager extends BaseManager
{
    public function getRules()
    {
        return $rules = [
            'name'        => 'required|max:255|unique:departments,name, '.$this->entity->id,
            'description' => '',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['slug']   = \Str::slug($data['name']);

        return $data;
    }
}
