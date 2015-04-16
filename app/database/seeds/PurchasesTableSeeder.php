<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\purchase\Purchase;

class PurchasesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Purchase::create([
				'folio'				=> "00000$index",
				'status'			=> "Pagado",
				'date'				=> $faker->date(),
				'reception_date'	=> $faker->date(),
				'iva'				=> '16',
				'progress_1'		=> '1',
				'progress_2'		=> '1',
				'progress_3'		=> '1',
				'progress_4'		=> '1',
				'provider_id'		=> $faker->randomElement([1,2]),
				'user_id'			=> '1',
			]);
		}
	}

}