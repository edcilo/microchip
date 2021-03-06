<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\provider\Provider;

class ProvidersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Provider::create([
            'name'                => 'CT Internacional del noroeste S.A. de C.V.',
            'rfc'                => 'CTIN151901POI',
            'email'                => 'ventas@cti.com',
            'number'            => '9614782569',
            'classification'    => 'Hardware',
            'state'                => 'Chiapas',
            'city'                => 'Tuxtla Gutierrez',
            'postcode'            => '29018',
            'address'            => 'Central no. 150',
            'address_warranty'    => 'Col. algo',
            'days_credit'        => '365',
            'credit_limit'        => '50000',
            'observations'        => 'lorem ipsum',
            'active'            => 1,
            'slug'                => \Str::slug('CT Internacional del noroeste S.A. de C.V.'),
        ]);

        Provider::create([
            'name'                => 'Mercado Libre',
            'rfc'                => '',
            'email'                => '',
            'number'            => '',
            'classification'    => 'Web',
            'state'                => '',
            'city'                => '',
            'postcode'            => '',
            'address'            => '',
            'address_warranty'    => '',
            'days_credit'        => '',
            'credit_limit'        => '',
            'observations'        => 'Compras en línea',
            'active'            => 1,
            'slug'                => \Str::slug('Mercado Libre'),
        ]);

        for ($i = 0; $i < 150; $i++) {
            $name = $faker->name;

            Provider::create([
                'name'              => $name,
                'rfc'               => '',
                'email'             => $faker->email,
                'number'            => $faker->phoneNumber,
                'classification'    => $faker->randomElement(['hardware', 'software', 'web']),
                'state'             => $faker->state,
                'city'              => $faker->city,
                'postcode'          => $faker->postcode,
                'address'           => $faker->address,
                'address_warranty'  => $faker->randomElement(['', $faker->address]),
                'days_credit'       => 0,
                'credit_limit'      => 0,
                'observations'      => $faker->text(),
                'active'            => $faker->randomElement([1,0,1,1]),
                'slug'              => \Str::slug($name),
            ]);
        }
    }
}
