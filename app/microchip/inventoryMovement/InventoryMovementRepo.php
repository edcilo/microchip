<?php

namespace microchip\inventoryMovement;

use Carbon\Carbon;
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

    public function getSold($days, $product_id)
    {
        $today = Carbon::today()->subDays($days)->format('Y-m-d');

        return InventoryMovement::where('product_id', $product_id)
            ->where('status', 'out')
            ->where('created_at', '>', $today)
            ->sum('quantity');
    }
}
