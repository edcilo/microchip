<?php

namespace microchip\product;

use microchip\base\BaseManager;

class ProductUpdManager extends BaseManager
{
    public function getRules()
    {
        $rules = [
            'barcode'       => 'required|unique:products,barcode,'.$this->entity->id,
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

        if ($this->entity->type == 'Producto') {
            $rules += [
                'model'             => 'required|max:120',
                'have_series'       => 'boolean',
                'purchase_price'    => 'required|numeric',
                'data_sheet'        => 'mimes:jpeg,png,gif,pdf',
                'box'               => 'boolean',
                'pieces'            => 'integer',
                'stock_min'         => 'integer',
                'stock_max'         => 'integer',
                'provider'          => 'max:120',
                'provider_barcode'  => 'max:120',
                'provider_warranty' => 'integer',
                'category_id'       => 'required|exists:categories,id',
                'mark_id'           => 'required|exists:marks,id',
            ];
        }

        return $rules;
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['barcode']    = strtoupper($data['barcode']);
        $data['barcode']    = str_replace(['-', ' '], '.', $data['barcode']);
        $data['active']     = 1;
        $data['slug']       = \Str::slug($data['barcode']);
        $data['type']       = $this->entity->type;

        $path           = 'images/product';
        if ($this->entity->image != 'images/product/default.png') {
            $path_image     = $this->saveFile(\Input::file('image'), $path, false, $data['slug'], false, true, $this->entity->image);
        } else {
            $path_image     = $this->saveFile(\Input::file('image'), $path, false, $data['slug']);
        }
        $data['image']  = ($path_image) ? $path_image : $this->entity->image;

        return $data;
    }
}
