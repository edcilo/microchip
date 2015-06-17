<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use microchip\company\Company;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        Company::create([
            'name'      => 'Microchip Computadoras Y Tecnología',
            'owner'     => 'Cleiver Ocatvio Coello Coello',
            'rfc'       => 'COCC711020HN9',
            'photo'     => 'images/company/default.png',
            'state'     => 'Chiapas',
            'city'      => 'Tuxtla Gutierrez',
            'colony'    => 'Centro',
            'address'   => '2a Av. Sur Ote. No. 372',
            'phone_1'   => '962 61 398 66',
            'phone_2'   => '962 61 398 66',
            'phone_3'   => '961 7080 454',
            'email'     => 'ventas@microchip.com.mx',
            'web'       => 'http://www.microchip.com.mx',
            'services'  => 'De todo y mas.',
            'schedule'  => 'De Lunes a Viernes de 9:00a.m. a 8:00p.m.; Sábados de 9:00a.m. a 7:00p.m.',
            'note'      => 'Gracias por su compra.',
        ]);
    }
}
