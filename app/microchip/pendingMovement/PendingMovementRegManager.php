<?php

namespace microchip\pendingMovement;

use microchip\base\BaseManager;

class PendingMovementRegManager extends BaseManager
{
    public function getRules()
    {
        return [
            'barcode'       => 'required',
            's_description' => 'required|max:120',
            'l_description' => '',
            'provider_link' => 'url',
            'image_link'    => 'url',
            'quantity'      => 'required|integer',
            'selling_price' => 'required|numeric',
            'w_iva'         => 'required|boolean',
            'dollar'        => 'required|boolean',
            'utility'       => 'required|numeric',
            'shipping'      => 'numeric',
            'sale_id'       => 'required|integer|exists:sales,id',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        if (empty($data['image_link'])) {
            $data['image_link'] = 'images/product/default.png';
        }

        $data['barcode']    = strtoupper($data['barcode']);
        $data['product_id'] = 0;

        return $data;
    }
}
