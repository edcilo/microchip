<?php

namespace microchip\inventoryMovement;

use microchip\base\BaseManager;
use microchip\product\ProductRepo;

class InventoryMovementSRegManager extends BaseManager
{
    public function getRules()
    {
        $minSellingPrice = 0;
        $max = '';
        $movement_in = '';

        if (!empty($this->data['product_id'])) {
            $product = new ProductRepo();
            $product = $product->find($this->data['product_id']);
            $minSellingPrice = $product->price_5 * ($this->data['iva'] / 100 + 1);

            $this->data['warranty'] = $product->warranty;

            if ($product->type == 'Producto') {
                $max = '|max:'.$this->data['total_in_stock'];
                $movement_in = 'required|exists:inventory_movements,id';
            }
        }

        return [
            'product_id'        => 'required|exists:products,id',
            'quantity'          => 'required|integer|min:1'.$max,
            'purchase_price'    => 'required|numeric',
            'selling_price'     => 'required|numeric|min:'.$minSellingPrice,
            'warranty'          => 'required|integer|min:0',
            'movement_in_id'    => $movement_in,
        ];
    }

    public function prepareData($data)
    {
        $data['in_stock']       = 0;
        $data['status']         = 'out';
        $data['description']    = 'Venta';

        return $data;
    }
}
