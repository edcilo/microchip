<?php

namespace microchip\productDescription;

use microchip\base\BaseManager;

class ProductDescriptionUpdManager extends BaseManager
{
    public function getRules()
    {
        return [
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

    public function prepareData($data)
    {
        $path               = 'images/product';
        $path_file          = $this->saveFile(\Input::file('data_sheet'), $path, true, $data['model'], false, true, $this->entity->data_sheet);
        $data['data_sheet'] = ($path_file) ? $path_file : $this->entity->data_sheet;

        return $data;
    }
}
