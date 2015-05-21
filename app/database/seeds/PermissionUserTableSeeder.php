<?php

class PermissionUserTableSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 123) as $index) {
            \DB::table('permission_user')->insert([
                'user_id'       => 1,
                'permission_id' => $index,
            ]);
        }


        \DB::table('permission_user')->insert([
            'user_id'       => 3,
            'permission_id' => 77
        ]);

        \DB::table('permission_user')->insert([
            'user_id'       => 3,
            'permission_id' => 78
        ]);

        \DB::table('permission_user')->insert([
            'user_id'       => 3,
            'permission_id' => 81
        ]);



        \DB::table('permission_user')->insert([
            'user_id'       => 3,
            'permission_id' => 85
        ]);

        \DB::table('permission_user')->insert([
            'user_id'       => 3,
            'permission_id' => 86
        ]);

        \DB::table('permission_user')->insert([
            'user_id'       => 3,
            'permission_id' => 87
        ]);


        \DB::table('permission_user')->insert([
            'user_id'       => 3,
            'permission_id' => 94
        ]);

        \DB::table('permission_user')->insert([
            'user_id'       => 3,
            'permission_id' => 95
        ]);

        \DB::table('permission_user')->insert([
            'user_id'       => 3,
            'permission_id' => 96
        ]);

    }
}
