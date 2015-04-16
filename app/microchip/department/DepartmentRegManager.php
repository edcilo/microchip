<?php namespace microchip\department;

use microchip\base\BaseManager;

class DepartmentRegManager extends BaseManager {

    public function getRules()
    {
        return $rules = [
            'name'        => 'required|max:255|unique:departments,name',
            'description' => ''
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['slug']   = \Str::slug($data['name']);

        return $data;
    }

} 