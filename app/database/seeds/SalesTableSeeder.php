<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\sale\Sale;

class SalesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10000) as $index) {
            Sale::create([
                'folio'             => str_pad($index, 8, '0', STR_PAD_LEFT),
                'iva'                => 16,
                'type'                => $faker->randomElement(['Ticket', 'Factura']),
                'classification'    => 'Venta',
                'status'            => $faker->randomElement(['Pagado', 'Cancelado']),
                'description'        => $faker->text(90),
                'delivery_date'     => $faker->date(),
                'customer_id'        => $faker->numberBetween(1, 10),
                'user_id'            => 2,
            ]);
        }
    }
}
