<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\cheque\Cheque;

class ChequesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 1000) as $index) {
            $status = $faker->randomElement(['Disponible', 'Pagado', 'Cancelado', 'Post-fechado','Elaborado', 'Parcial']);

            Cheque::create([
                'folio'         => '000000'.$index,
                'payment_date'  => ($status != 'Disponible') ? $faker->dateTimeThisYear : null,
                'amount'        => ($status != 'Disponible') ? $faker->numberBetween(100, 10000) : 0,
                'receiver'      => ($status != 'Disponible') ? $faker->name : '',
                'concept'       => ($status != 'Disponible') ? $faker->text() : '',
                'status'        => $status,
                'active'        => $faker->randomElement([1,0,1,1]),
                'message'       => $faker->randomElement([0, 1]),
                'observations'  => $faker->text(),
                'bank_id'       => $faker->numberBetween(1,151),
            ]);
        }
    }
}
