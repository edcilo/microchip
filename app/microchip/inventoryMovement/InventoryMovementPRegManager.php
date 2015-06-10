<?php

namespace microchip\inventoryMovement;

use microchip\base\BaseManager;
use microchip\product\ProductRepo;

class InventoryMovementPRegManager extends BaseManager
{
    public function getRules()
    {
        return [
            'quantity'          => 'required|integer',
            'purchase_price'    => 'required|numeric',
            //'product_id'        => 'required|exists:products,id',
            'barcode'           => 'required|exists:products,barcode',
            'purchase_id'       => 'required|exists:purchases,id',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $product_repo       = new ProductRepo();
        $product            = $product_repo->getByBarcode($data['barcode']);
        $data['product_id'] = $product->id;

        $data['in_stock']       = $data['quantity'];
        $data['status']         = 'in';
        $data['selling_price']  = 0;
        $data['description']    = 'Compra';

        return $data;
    }
}
