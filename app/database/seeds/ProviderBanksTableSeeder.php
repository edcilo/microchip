<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\providerBank\ProviderBank;

class ProviderBanksTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 4) as $index)
		{
			ProviderBank::create([
				'bank'			=> $faker->name,
				'account'		=> $faker->numberBetween(100000, 999999),
				'plaza'			=> $faker->numberBetween(100000, 999999),
				'clabe'			=> $faker->numberBetween(100000, 999999),
				'provider_id'	=> $faker->numberBetween(1, 2)
			]);
		}
	}

}