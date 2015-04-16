<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\cheque\Cheque;

class ChequesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 9) as $index)
		{
			Cheque::create([
				'folio'			=> '000000' . $index,
				'payment_date'	=> 0,
				'amount'		=> 0,
				'receiver'		=> '',
				'concept'		=> '',
				'status'		=> 'Disponible',
				'active'		=> 1,
				'message'		=> $faker->randomElement([0, 1]),
				'observations'	=> $faker->text(),
				'bank_id'		=> 1,
			]);
		}
	}

}