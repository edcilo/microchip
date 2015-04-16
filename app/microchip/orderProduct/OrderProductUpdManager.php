<?php namespace microchip\orderProduct;

use microchip\base\BaseManager;

class OrderProductUpdManager extends BaseManager {

    public function getRules()
    {
        return [
            'quantity'      => 'required|integer',
            'selling_price' => 'required|numeric',
            'sale_id'       => 'required|exists:sales,id',
            'product_id'    => 'required|exists:products,id'
        ];
    }

    public function prepareData($data)
    {
        return $data;
    }

}