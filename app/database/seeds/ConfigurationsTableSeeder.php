<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\configuration\Configuration;

class ConfigurationsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Configuration::create([
			'iva'		=> '16',
			'dollar'	=> '14.83'
		]);
	}

}