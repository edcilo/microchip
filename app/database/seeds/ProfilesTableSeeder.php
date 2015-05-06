<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\profile\Profile;

class ProfilesTableSeeder extends Seeder
{
    public function run()
    {
        Profile::create([
            'name'              => 'Admin',
            'photo'                => 'images/user/default.png',
            'birthday'            => date('Y-m-d'),
            'sex'                => 'Masculino',
            'user_id'            => 1,
            'marital_status'    => 'Soltero',
            'hired'                => date('Y-m-d'),
        ]);

        $faker = Faker::create();

        foreach (range(2, 3) as $index) {
            Profile::create([
                'name'                => $faker->name,
                'f_last_name'        => $faker->lastName,
                's_last_name'        => $faker->lastName,
                'photo'                => 'images/user/default.png',
                'birthday'            => $faker->date(),
                'sex'                => $faker->randomElement(['Masculino', 'Femenino']),
                'phone'                => $faker->phoneNumber,
                'cellphone'            => $faker->phoneNumber,
                'email'                => $faker->email,
                'country'            => $faker->country,
                'state'                => $faker->streetName,
                'postcode'            => $faker->postcode,
                'city'                => $faker->city,
                'colony'            => $faker->streetName,
                'address'            => $faker->streetAddress,
                'marital_status'    => $faker->randomElement(['Casado', 'Soltero']),
                'wife'                => $faker->name.$faker->lastName,
                'reference_1'        => $faker->name.$faker->lastName,
                'reference_2'        => $faker->name.$faker->lastName,
                'reference_3'        => $faker->name.$faker->lastName,
                'ref_phone_1'        => $faker->phoneNumber,
                'ref_phone_2'        => $faker->phoneNumber,
                'ref_phone_3'        => $faker->phoneNumber,
                'hired'                => $faker->date(),
                'salary'            => 1500,
                'commission'        => $faker->numberBetween(0, 10),
                'goal'                => $faker->numberBetween(3000, 9000),
                'current'            => 0,
                'fired'                => '',
                'reason'            => '',
                'observations'        => $faker->text(),
                'user_id'            => $index,
            ]);
        }
    }
}
