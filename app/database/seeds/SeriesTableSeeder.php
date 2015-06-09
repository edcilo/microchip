<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\series\Series;

class SeriesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 6; $i++) {
            Series::create([
                'ns'                    => 'LAP.N5110.1.'.$i,
                'status'                => 'Disponible',
                'product_id'            => 1,
                'inventory_movement_id' => 4,
            ]);
        }

        for ($i = 0; $i < 6; $i++) {
            Series::create([
                'ns'                    => 'JOY.MM.80.'.$i,
                'status'                => 'Disponible',
                'product_id'            => 2,
                'inventory_movement_id' => 1,
            ]);
        }

        for ($i = 0; $i < 26; $i++) {
            Series::create([
                'ns'                    => 'MOU.317.'.$i,
                'status'                => 'Disponible',
                'product_id'            => 4,
                'inventory_movement_id' => 6,
            ]);
        }
    }
}
