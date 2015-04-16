<?php namespace microchip\product;

use microchip\base\BaseManager;

class ProductRegManager extends BaseManager {

    public function getRules()
    {
        return [
            'barcode'       => 'required|unique:products',
            'type'          => 'in:Producto,Servicio',
            's_description' => 'required|max:120',
            'description'   => '',
            'image'         => 'image',
            'price_1'       => 'required|numeric',
            'price_2'       => 'required|numeric',
            'price_3'       => 'required|numeric',
            'price_4'       => 'required|numeric',
            'price_5'       => 'required|numeric',
            'offer'         => 'integer|min:0|max:5',
            'points'        => 'numeric',
            'r_points'      => 'numeric',
            'warranty'      => 'integer',
            'web'           => 'boolean',
            'active'        => 'boolean',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['barcode']    = strtoupper($data['barcode']);
        $data['barcode']    = str_replace(['-', ' '], '.', $data['barcode']);
        $data['active']     = 1;
        $data['slug']       = \Str::slug($data['barcode']);

        $path               = 'images/product';
        $path_image         = $this->saveFile(\Input::file('image'), $path, false, $data['slug']);
        $data['image']      = ( $path_image ) ? $path_image : $path . '/default.png';

        return $data;
    }

}