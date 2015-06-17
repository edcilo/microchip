<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use microchip\configuration\Configuration;

class ConfigurationsTableSeeder extends Seeder
{
    public function run()
    {
        Configuration::create([
            'iva'               => '16',
            'dollar'            => '14.83',
            'coupon_terms_use'  => '',
        ]);
    }
}
