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
            'name'                => 'Scotiabank',
            'number_account'    => '08506826385',
            'branch'            => '004',
            'clabe'                => '044100085068263854',
            'executive_name'    => $faker->name,
            'active'            =>    1,
            'phone'                => $faker->phoneNumber,
            'country'            => 'México',
            'state'                => 'Chiapas',
            'city'                => 'Tuxtla Gutierrez',
            'postcode'            => $faker->postcode,
            'colony'            => 'Centro',
            'address'            => $faker->address,
            'terminal'            => 0,
            'commission_debit'    => 0,
            'commission_credit'    => 0,
            'slug'                => \Str::slug('Scotiabank'),
        ]);
    }
}
