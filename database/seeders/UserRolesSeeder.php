<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Manager',
            'Employee'
        ];
        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'role_name' => $role,
                'base_salary' => rand(100000, 10000000),
                'tax' => rand(1000, 10000),
                'deductions' => rand(1000, 10000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
