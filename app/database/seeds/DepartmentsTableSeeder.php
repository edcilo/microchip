<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\department\Department;

class DepartmentsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

        Department::create([
            'name'          => 'Administradores',
            'description'   => 'Empleados con privilegios de administración del sistema.',
            'slug'          => \Str::slug('Administradores'),
        ]);

		Department::create([
			'name'			=> 'Ventas',
			'description'	=> 'Empleado de ventas de mostrador.',
			'slug'			=> \Str::slug('Ventas'),
		]);

		Department::create([
			'name'			=> 'Almacen',
			'description'	=> 'Empleado de control de almacen e inventario.',
			'slug'			=> \Str::slug('Almacen'),
		]);
	}

}