<?php

namespace microchip\product;

use microchip\base\BaseManager;

class ProductUpdPricesManager extends BaseManager
{
    public function getRules()
    {
        $rules = [
            'price_1'       => 'required|numeric',
            'price_2'       => 'required|numeric',
            'price_3'       => 'required|numeric',
            'price_4'       => 'required|numeric',
            'price_5'       => 'required|numeric',
            'offer'         => 'integer|min:0|max:5',
        ];

        if ($this->entity->type == 'Producto') {
            $rules['purchase_price'] = 'required|numeric';
        }

        return $rules;
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        if (empty($data['offer'])) {
            $data['offer'] = 0;
        }

        return $data;
    }
}
