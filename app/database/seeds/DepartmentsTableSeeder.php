<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use microchip\department\Department;

class DepartmentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Department::create([
            'name'          => 'Administradores',
            'description'   => 'Empleados con privilegios de administración del sistema.',
            'slug'          => \Str::slug('Administradores'),
        ]);

        Department::create([
            'name'          => 'Ventas',
            'description'   => 'Empleado de ventas de mostrador.',
            'slug'          => \Str::slug('Ventas'),
        ]);
/*
        Department::create([
            'name'          => 'Almacen',
            'description'   => 'Empleado de control de almacen e inventario.',
            'slug'          => \Str::slug('Almacen'),
        ]);

        for ($i = 0; $i < 30; $i++) {
            $name = $faker->sentence($faker->randomElement([1, 2, 3, 4]));

            Department::create([
                'name'          => $name,
                'description'   => $faker->text(),
                'slug'          => \Str::slug($name),
            ]);
        }
*/
    }
}
