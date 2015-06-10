<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\productDescription\ProductDescription;

class ProductDescriptionsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        ProductDescription::create([
            'model'                => 'N5110',
            'have_series'        => '1',
            'purchase_price'    => '9998.99',
            'data_sheet'        => '',
            'box'                => '0',
            'pieces'            => '0',
            'stock_min'            => '0',
            'stock_max'            => '5',
            'quantity'            => '3',
            'provider'            => '',
            'provider_barcode'    => 'PRO.LAP.DELL.N5110',
            'provider_warranty'    => '365',
            'category_id'        => '4',
            'mark_id'            => '2',
            'product_id'        => '1',
        ]);

        ProductDescription::create([
            'model'                => 'MM80',
            'have_series'        => '1',
            'purchase_price'    => '650.50',
            'data_sheet'        => '',
            'box'                => '0',
            'pieces'            => '0',
            'stock_min'            => '0',
            'stock_max'            => '5',
            'quantity'            => '5',
            'provider'            => '',
            'provider_barcode'    => 'PRO.CON.XBOX.MM80',
            'provider_warranty'    => '365',
            'category_id'        => '3',
            'mark_id'            => '4',
            'product_id'        => '2',
        ]);

        ProductDescription::create([
            'model'                => 'ASD 123',
            'have_series'        => '0',
            'purchase_price'    => '68.95',
            'data_sheet'        => '',
            'box'                => '0',
            'pieces'            => '0',
            'stock_min'            => '5',
            'stock_max'            => '25',
            'quantity'            => '10',
            'provider'            => '',
            'provider_barcode'    => 'PRO.AUR.SONY.ASD123',
            'provider_warranty'    => '180',
            'category_id'        => '1',
            'mark_id'            => '1',
            'product_id'        => '3',
        ]);

        ProductDescription::create([
            'model'                => 'M317',
            'have_series'        => '1',
            'purchase_price'    => '78.59',
            'data_sheet'        => '',
            'box'                => '0',
            'pieces'            => '0',
            'stock_min'            => '5',
            'stock_max'            => '30',
            'quantity'            => '10',
            'provider'            => '',
            'provider_barcode'    => 'PRO.MOU.ACTECK.M317',
            'provider_warranty'    => '365',
            'category_id'        => '5',
            'mark_id'            => '3',
            'product_id'        => '4',
        ]);

        for ($i = 8; $i < 108; $i++) {
            ProductDescription::create([
                'model'             => $faker->creditCardNumber(),
                'have_series'       => $faker->randomElement([1,0]),
                'purchase_price'    => $faker->numberBetween(30,500),
                'data_sheet'        => '',
                'box'               => '0',
                'pieces'            => '0',
                'stock_min'         => $faker->numberBetween(0,5),
                'stock_max'         => $faker->numberBetween(6,20),
                'provider'          => '',
                'provider_barcode'  => $faker->creditCardNumber(),
                'provider_warranty' => $faker->numberBetween(30, 365),
                'category_id'       => $faker->numberBetween(1, 15),
                'mark_id'           => $faker->numberBetween(1, 25),
                'product_id'        => $i,
            ]);
        }
    }
}
