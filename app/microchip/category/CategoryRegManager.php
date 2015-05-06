<?php

namespace microchip\category;

use microchip\base\BaseManager;

class CategoryRegManager extends BaseManager
{
    public function getRules()
    {
        return [
            'name'          => 'required|unique:categories',
            'image'         => 'image',
            'description'   => '',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['slug']   = \Str::slug($data['name']);

        $path           = 'images/category';
        $path_image     = $this->saveFile(\Input::file('image'), $path, false, $data['slug']);
        $data['image']  = ($path_image) ? $path_image : $path.'/default.png';

        return $data;
    }
}
