<?php

namespace microchip\inventoryMovement;

use microchip\base\BaseRepo;

class InventoryMovementRepo extends BaseRepo
{
    public function getModel()
    {
        return new InventoryMovement();
    }

    public function newMovement()
    {
        return $movement = new InventoryMovement();
    }

    public function firstIn($id)
    {
        return InventoryMovement::where('product_id', $id)
            ->where('status', 'in')
            ->where('in_stock', '>', 0)
            ->first();
    }

    public function totalStock($id)
    {
        return InventoryMovement::where('product_id', $id)
            ->sum('in_stock');
    }
}
