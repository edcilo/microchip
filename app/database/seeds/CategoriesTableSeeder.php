<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\category\Category;

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Category::create([
			'name'			=> 'Auriculares',
			'image'			=> 'images/category/default.png',
			'description'	=> $faker->text(),
			'slug'			=> \Str::slug('Auriculares')
		]);

		Category::create([
			'name'			=> 'Baterias',
			'image'			=> 'images/category/default.png',
			'description'	=> $faker->text(),
			'slug'			=> \Str::slug('Baterias')
		]);

		Category::create([
			'name'			=> 'Joystick',
			'image'			=> 'images/category/default.png',
			'description'	=> $faker->text(),
			'slug'			=> \Str::slug('Joystick')
		]);

		Category::create([
			'name'			=> 'Laptops',
			'image'			=> 'images/category/default.png',
			'description'	=> $faker->text(),
			'slug'			=> \Str::slug('Laptops')
		]);

		Category::create([
			'name'			=> 'Mouses',
			'image'			=> 'images/category/default.png',
			'description'	=> $faker->text(),
			'slug'			=> \Str::slug('Mouses')
		]);
	}

}