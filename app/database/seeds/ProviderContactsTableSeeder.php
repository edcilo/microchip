<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\providerContact\ProviderContact;

class ProviderContactsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 6) as $index)
		{
			ProviderContact::create([
				'name'			=> $faker->name,
				'last_name'		=> $faker->lastName,
				'job'			=> $faker->word,
				'phone'			=> $faker->phoneNumber,
				'email'			=> $faker->email,
				'provider_id'	=> $faker->numberBetween(1, 2),
			]);
		}
	}

}