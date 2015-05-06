<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\purchasePayment\PurchasePayment;

class PurchasePaymentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            PurchasePayment::create([
                'purchase_id'    => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
                'cheque_id'        => 0,
                'method'        => $faker->randomElement(['Contado', 'Crédito']),
                'type'            => $faker->randomElement(['Efectivo', 'Transferencia', 'Nota de crédito']),
                'payment_date'    => $faker->date(),
                'status'        => 'Pagado',
            ]);
        }
    }
}
