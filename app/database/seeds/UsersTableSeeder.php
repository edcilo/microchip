<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\user\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        User::create([
            'username'      => 'admin',
            'password'      => \Hash::make('admin'),
            'slug'          => \Str::slug('admin'),
            'active'        => 1,
            'department_id' => 1,
        ]);

        User::create([
            'username'        => 'edcilo_a',
            'password'        => \Hash::make('qwerty'),
            'slug'            => \Str::slug('edcilo_a'),
            'active'        => 1,
            'department_id'    => 2,
        ]);

        User::create([
            'username'        => 'edcilo_v',
            'password'        => \Hash::make('secret'),
            'slug'            => \Str::slug('edcilo_v'),
            'active'        => 1,
            'department_id'    => 3,
        ]);
    }
}
