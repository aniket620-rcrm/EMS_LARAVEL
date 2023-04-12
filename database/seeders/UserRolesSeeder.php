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
            'Admin',
            'Manager',
            'Employee'
        ];
        foreach ($roles as $role) {
            DB::table('user_roles')->insert([
                'role_name' => $role,
                'base_salary' => rand(1000000, 10000000),
                'tax_%' => rand(1,30),
                'deductions' => rand(1000, 10000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
