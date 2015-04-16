<?php namespace microchip\mark;

use microchip\base\BaseManager;

class MarkRegManager extends BaseManager {

    public function getRules()
    {
        return [
            'name'          => 'required|unique:marks',
            'image'         => 'image',
            'description'   => '',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['slug']   = \Str::slug($data['name']);

        $path           = 'images/mark';
        $path_image     = $this->saveFile(\Input::file('image'), $path, false, $data['slug']);
        $data['image']  = ( $path_image ) ? $path_image : $path . '/default.png';

        return $data;
    }

}