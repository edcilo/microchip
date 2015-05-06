<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\inventoryMovement\InventoryMovement;

class InventoryMovementsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        InventoryMovement::create([
            'product_id'        => 2,
            'in_stock'            => 5,
            'quantity'            => 5,
            'status'            => 'in',
            'purchase_price'    => 150,
            'selling_price'        => 0,
            'description'        => 'En inventario',
        ]);

        InventoryMovement::create([
            'product_id'        => 2,
            'in_stock'            => 10,
            'quantity'            => 10,
            'status'            => 'in',
            'purchase_price'    => 160,
            'selling_price'        => 0,
            'description'        => 'En inventario',
        ]);

        InventoryMovement::create([
            'product_id'        => 2,
            'in_stock'            => 7,
            'quantity'            => 7,
            'status'            => 'in',
            'purchase_price'    => 155,
            'selling_price'        => 0,
            'description'        => 'En inventario',
        ]);

        InventoryMovement::create([
            'product_id'        => 1,
            'in_stock'            => 5,
            'quantity'            => 5,
            'status'            => 'in',
            'purchase_price'    => 9998.99,
            'selling_price'        => 0,
            'description'        => 'En inventario',
        ]);

        InventoryMovement::create([
            'product_id'        => 3,
            'in_stock'            => 25,
            'quantity'            => 25,
            'status'            => 'in',
            'purchase_price'    => 79.98,
            'selling_price'        => 0,
            'description'        => 'En inventario',
        ]);

        InventoryMovement::create([
            'product_id'        => 4,
            'in_stock'            => 25,
            'quantity'            => 25,
            'status'            => 'in',
            'purchase_price'    => 125.32,
            'selling_price'        => 0,
            'description'        => 'En inventario',
        ]);
    }
}
