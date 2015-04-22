<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\customer\Customer;

class CustomersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Customer::create([
            'prefix'            => '',
			'name'				=> 'Mostrador',
			'country'			=> 'México',
			'state'				=> 'Chiapas',
			'city'				=> 'Tuxtla Gutierrez',
			'postcode'			=> '29025',
			'colony'			=> 'Centro',
			'address'			=> '',
			'birthday'			=> '',
			'phone'				=> '',
			'cellphone'			=> '',
			'email'				=> '',
			'rfc'				=> '',
			'credit_limit'		=> 0,
			'credit_days'		=> 0,
			'classification'	=> 'Cliente',
			'legal_concept'		=> 'Ninguno',
			'card_id'			=> '',
			'points'			=> 0,
			'expiration'		=> 0,
			'card_active'		=> '',
			'slug'				=> \Str::slug('Mostrador'),
			'active'			=> 1,
		]);

		foreach(range(2, 10) as $index)
		{
			$name = $faker->name;
			Customer::create([
                'prefix'            => $faker->randomElement(['', 'Lic.', 'Ing.']),
				'name'				=> $name,
				'country'			=> 'México',
				'state'				=> 'Chiapas',
				'city'				=> 'Tuxtla Gutierrez',
				'postcode'			=> '29025',
				'colony'			=> 'Centro',
				'address'			=> $faker->address,
                'shipping_address'  => $faker->address,
				'birthday'			=> $faker->date(),
				'phone'				=> $faker->phoneNumber,
				'cellphone'			=> $faker->phoneNumber,
				'email'				=> $faker->email,
				'rfc'				=> '',
				'credit_limit'		=> 0,
				'credit_days'		=> 0,
				'classification'	=> $faker->randomElement(['Cliente', 'Distribuidor']),
				'legal_concept'		=> $faker->randomElement(['Ninguno','Persona Física','Persona Moral']),
				'card_id'			=> 'ECD4589ASD8S7D5F6C2D4S7E8R9F6D5V2F3D',
				'points'			=> 0,
				'expiration'		=> $faker->numberBetween(90, 730),
				'card_active'		=> $faker->date(),
				'slug'				=> \Str::slug($name),
				'active'			=> 1,
			]);
		}
	}

}