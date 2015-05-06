<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\mark\Mark;

class MarksTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Mark::create([
            'name'            => 'Sony',
            'image'            => 'images/mark/default.png',
            'description'    => $faker->text(),
            'slug'            => \Str::slug('Sony'),
        ]);

        Mark::create([
            'name'            => 'Dell',
            'image'            => 'images/mark/default.png',
            'description'    => $faker->text(),
            'slug'            => \Str::slug('Dell'),
        ]);

        Mark::create([
            'name'            => 'Acteck',
            'image'            => 'images/mark/default.png',
            'description'    => $faker->text(),
            'slug'            => \Str::slug('Acteck'),
        ]);

        Mark::create([
            'name'            => 'Microsoft',
            'image'            => 'images/mark/default.png',
            'description'    => $faker->text(),
            'slug'            => \Str::slug('Microsoft'),
        ]);

        Mark::create([
            'name'            => 'HP',
            'image'            => 'images/mark/default.png',
            'description'    => $faker->text(),
            'slug'            => \Str::slug('HP'),
        ]);
    }
}
