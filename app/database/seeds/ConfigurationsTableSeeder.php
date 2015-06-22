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

            'width_paper_barcode' => 5,
            'height_paper_barcode' => 3,
            'width_bar_document_barcode' => 0.25,
            'height_document_barcode' => 8,
            'width_bar_product_barcode' => 0.25,
            'height_product_barcode' => 8,
            'width_bar_series_barcode' => 0.25,
            'height_series_barcode' => 6,
        ]);
    }
}
