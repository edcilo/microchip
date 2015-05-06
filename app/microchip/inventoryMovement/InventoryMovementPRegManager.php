<?php

namespace microchip\inventoryMovement;

use microchip\base\BaseManager;

class InventoryMovementPRegManager extends BaseManager
{
    public function getRules()
    {
        return [
            'quantity'          => 'required|integer',
            'purchase_price'    => 'required|numeric',
            'product_id'        => 'required|exists:products,id',
            'purchase_id'        => 'required|exists:purchases,id',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['in_stock']       = $data['quantity'];
        $data['status']         = 'in';
        $data['selling_price']  = 0;
        $data['description']    = 'Compra';

        return $data;
    }
}
