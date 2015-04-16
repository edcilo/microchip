<?php namespace microchip\mark;

use microchip\base\BaseManager;

class MarkUpdManager extends BaseManager {

    public function getRules()
    {
        return [
            'name'          => 'required|unique:marks,name,' . $this->entity->id,
            'image'         => 'image',
            'description'   => '',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['slug']   = \Str::slug($data['name']);

        $path           = 'images/mark';
        if ($this->entity->image != 'images/mark/default.png') {
            $path_photo     = $this->saveFile(\Input::file('image'), $path, false, $data['slug'], false, true, $this->entity->image);
        } else {
            $path_photo     = $this->saveFile(\Input::file('image'), $path, false, $data['slug']);
        }
        $data['image']  = ( $path_photo ) ? $path_photo : $this->entity->image;

        return $data;
    }

}