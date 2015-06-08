<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\bank\Bank;

class BanksTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Bank::create([
            'name'                 => 'Scotiabank',
            'number_account'       => '08506826385',
            'branch'               => '004',
            'clabe'                => '044100085068263854',
            'executive_name'       => $faker->name,
            'active'               => 1,
            'phone'                => $faker->phoneNumber,
            'country'              => 'México',
            'state'                => 'Chiapas',
            'city'                 => 'Tuxtla Gutierrez',
            'postcode'             => $faker->postcode,
            'colony'               => 'Centro',
            'address'              => $faker->address,
            'terminal'             => 0,
            'commission_debit'     => 0,
            'commission_credit'    => 0,
            'slug'                 => \Str::slug('Scotiabank'),
        ]);

        for ($i = 0; $i < 150; $i++) {
            $name = $faker->word;

            Bank::create([
                'name'              => $name,
                'number_account'    => $faker->creditCardNumber,
                'branch'            => $faker->numberBetween(100, 999),
                'clabe'             => $faker->creditCardNumber,
                'executive_name'    => $faker->name,
                'active'            => $faker->randomElement([1,0,1]),
                'phone'             => $faker->phoneNumber,
                'country'           => $faker->country,
                'state'             => $faker->state,
                'city'              => $faker->city,
                'postcode'          => $faker->postcode,
                'colony'            => $faker->streetName,
                'address'           => $faker->address,
                'terminal'          => $faker->randomElement([1,0,1]),
                'commission_debit'  => $faker->randomElement([0,1,1]),
                'commission_credit' => $faker->randomElement([1,1,0]),
                'slug'              => \Str::slug($name),
            ]);
        }
    }
}
