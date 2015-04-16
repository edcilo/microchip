<?php namespace microchip\profile;

use microchip\base\BaseManager;

class ProfileRegManager extends BaseManager {

    public function getRules()
    {
        return [];
    }

    public function prepareData($data)
    {
        $path           = 'images/user';
        $path_image     = $this->saveFile(\Input::file('photo'), $path, false, $data['slug']);
        $data['photo']  = ( $path_image ) ? $path_image : $path . '/default.png';

        return $data;
    }

}