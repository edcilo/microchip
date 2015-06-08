<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\providerPhone\ProviderPhone;

class ProviderPhonesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 300) as $index) {
            ProviderPhone::create([
                'phone'          => $faker->phoneNumber,
                'provider_id'    => $faker->numberBetween(1, 152),
            ]);
        }
    }
}
