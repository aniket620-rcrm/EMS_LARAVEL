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
            ['role_name' => 'Manager'],
            ['role_name' => 'Employee'],
        ];

        for ($i = 1; $i <= 10; $i++) {
        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'role_name' => $role['role_name'],
                'base_salary' => rand(100000, 10000000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
}
}