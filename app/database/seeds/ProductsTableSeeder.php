<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\product\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Product::create([
            'barcode'        => 'LAP.N5110.1',
            'type'            => 'Producto',
            's_description'    => 'Laptop color negro, 8Gb Ram, procesador intel Core i7',
            'description'    => $faker->text(),
            'image'            => 'images/product/default.png',
            'price_1'        => 15298.45,
            'price_2'        => 14798.51,
            'price_3'        => 14298.56,
            'price_4'        => 13798.61,
            'price_5'        => 13298.66,
            'offer'         => $faker->numberBetween(0, 5),
            'points'        => 2,
            'r_points'        => 1,
            'warranty'        => 365,
            'web'            => 1,
            'active'        => 1,
            'slug'            => \Str::slug('LAP.N5110.1'),
        ]);

        Product::create([
            'barcode'        => 'JOY.MM.80',
            'type'            => 'Producto',
            's_description'    => 'Control de xbox alambrico usb',
            'description'    => $faker->text(),
            'image'            => 'images/product/default.png',
            'price_1'        => 955.96,
            'price_2'        => 921.82,
            'price_3'        => 887.68,
            'price_4'        => 853.54,
            'price_5'        => 819.4,
            'offer'         => $faker->numberBetween(0, 5),
            'points'        => 1,
            'r_points'        => 0.5,
            'warranty'        => 180,
            'web'            => 1,
            'active'        => 1,
            'slug'            => \Str::slug('JOY.MM.80'),
        ]);

        Product::create([
            'barcode'        => 'AUR.ASD.123',
            'type'            => 'Producto',
            's_description'    => 'Audifonos color negro',
            'description'    => $faker->text(),
            'image'            => 'images/product/default.png',
            'price_1'        => 86.04,
            'price_2'        => 83.19,
            'price_3'        => 80.34,
            'price_4'        => 77.49,
            'price_5'        => 74.64,
            'offer'         => $faker->numberBetween(0, 5),
            'points'        => 0.5,
            'r_points'        => 0.25,
            'warranty'        => 90,
            'web'            => 1,
            'active'        => 1,
            'slug'            => \Str::slug('AUR.ASD.123'),
        ]);

        Product::create([
            'barcode'        => 'MOU.317',
            'type'            => 'Producto',
            's_description'    => 'Mouse inhalambrico',
            'description'    => $faker->text(),
            'image'            => 'images/product/default.png',
            'price_1'        => 96.20,
            'price_2'        => 93.03,
            'price_3'        => 89.85,
            'price_4'        => 86.68,
            'price_5'        => 83.5,
            'offer'         => $faker->numberBetween(0, 5),
            'points'        => 1,
            'r_points'        => 0.5,
            'warranty'        => 180,
            'web'            => 1,
            'active'        => 1,
            'slug'            => \Str::slug('MOU.317'),
        ]);

        Product::create([
            'barcode'        => 'SER.ENTREGA.DOM',
            'type'            => 'Servicio',
            's_description'    => 'Entrega a domicilio',
            'description'    => $faker->text(),
            'image'            => 'images/product/default.png',
            'price_1'        => 150,
            'price_2'        => 100,
            'price_3'        => 80,
            'price_4'        => 60,
            'price_5'        => 40,
            'offer'         => $faker->numberBetween(0, 5),
            'points'        => 1,
            'r_points'        => 0.25,
            'warranty'        => 0,
            'web'            => 1,
            'active'        => 1,
            'slug'            => \Str::slug('SER.ENTREGA.DOM'),
        ]);

        Product::create([
            'barcode'        => 'SER.FORMATEO',
            'type'            => 'Servicio',
            's_description'    => 'Formatear el equipo de computo sin respaldo',
            'description'    => $faker->text(),
            'image'            => 'images/product/default.png',
            'price_1'        => 300,
            'price_2'        => 295,
            'price_3'        => 290,
            'price_4'        => 285,
            'price_5'        => 280,
            'offer'         => $faker->numberBetween(0, 5),
            'points'        => 1,
            'r_points'        => 0.25,
            'warranty'        => 60,
            'web'            => 1,
            'active'        => 1,
            'slug'            => \Str::slug('SER.FORMATEO'),
        ]);

        Product::create([
            'barcode'        => 'SER.FORMATEO.RESP',
            'type'            => 'Servicio',
            's_description'    => 'Formatear el equipo de computo con respalo',
            'description'    => $faker->text(),
            'image'            => 'images/product/default.png',
            'price_1'        => 350,
            'price_2'        => 345,
            'price_3'        => 340,
            'price_4'        => 335,
            'price_5'        => 330,
            'offer'         => $faker->numberBetween(0, 5),
            'points'        => 1,
            'r_points'        => 0.25,
            'warranty'        => 60,
            'web'            => 1,
            'active'        => 1,
            'slug'            => \Str::slug('SER.FORMATEO.RESP'),
        ]);

        for ($i = 0; $i < 100; $i++) {
            $barcode = $faker->creditCardNumber();

            Product::create([
                'barcode'        => $barcode,
                'type'           => $faker->randomElement(['Producto', 'Producto', 'Servicio']),
                's_description'  => $faker->paragraph(),
                'description'    => $faker->text(),
                'image'          => 'images/product/default.png',
                'price_1'        => $faker->numberBetween(401, 1000),
                'price_2'        => $faker->numberBetween(251, 400),
                'price_3'        => $faker->numberBetween(151, 250),
                'price_4'        => $faker->numberBetween(101, 150),
                'price_5'        => $faker->numberBetween(50, 100),
                'offer'          => $faker->numberBetween(0, 5),
                'points'         => $faker->randomElement([0.2,0.3,0.5,0.7,1,2,3]),
                'r_points'       => $faker->randomElement([0.1,0.2,0.4,0.6,0.8,1.5,2.2]),
                'warranty'       => $faker->randomElement([30,60,365]),
                'web'            => $faker->randomElement([1,0,1]),
                'active'         => $faker->randomElement([1,1,0,1]),
                'slug'           => \Str::slug($barcode),
            ]);
        }
    }
}
