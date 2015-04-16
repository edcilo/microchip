<?php namespace microchip\company;

use microchip\base\BaseManager;

class CompanyUpdManager extends BaseManager {

    public function getRules()
    {
        return $rules = [
            'name'     => 'required|max:255',
            'owner'    => 'required|max:255',
            'rfc'      => 'required|max:13',
            'photo'    => 'image',
            'state'   => 'required|max:255',
            'city'     => 'required|max:255',
            'colony'   => 'required|max:255',
            'address'  => 'required|max:255',
            'phone_1'  => 'required|max:255',
            'phone_2'  => 'max:255',
            'phone_3'  => 'max:255',
            'email'    => 'required|email',
            'web'      => 'url',
            'services' => 'max:255',
            'schedule' => 'max:255',
            'note'     => 'max:1024',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['id']    = 1;
        $data['rfc']   = strtoupper($data['rfc']);
        $data['note']  = nl2br($data['note']);

        $name           = \Str::slug($data['name']);

        $path           = 'images/company';
        $path_image     = $this->saveFile(\Input::file('photo'), $path, false, $name, false, true, $this->entity->photo);
        $data['photo']  = ( $path_image ) ? $path_image : $this->entity->photo;

        return $data;
    }

}