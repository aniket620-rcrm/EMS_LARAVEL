<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            0,
            1
        ];

        foreach($roles as $role) {
        DB::table('user_statuses')->insert([
            'status' => $role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
}
