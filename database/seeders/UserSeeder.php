<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        
        $role = \App\Models\roles::all();
        $user_status = \App\Models\UserStatus::all();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@example.com',
                'email_verified_at' => now(),
                'roles_id' => $role->random()->id,
                'user_statuses_id' => $user_status->random()->id,
                'joining_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
}