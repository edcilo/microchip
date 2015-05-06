<?php

namespace microchip\category;

use microchip\base\BaseManager;

class CategoryUpdManager extends BaseManager
{
    public function getRules()
    {
        return [
            'name'          => 'required|unique:categories,name,'.$this->entity->id,
            'image'         => 'image',
            'description'   => '',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['slug']   = \Str::slug($data['name']);

        $path           = 'images/category';
        if ($this->entity->image != 'images/category/default.png') {
            $path_photo     = $this->saveFile(\Input::file('image'), $path, false, $data['slug'], false, true, $this->entity->image);
        } else {
            $path_photo     = $this->saveFile(\Input::file('image'), $path, false, $data['slug']);
        }
        $data['image']  = ($path_photo) ? $path_photo : $this->entity->image;

        return $data;
    }
}
