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

        for ($i = 1; $i <= 10; $i++) {
        DB::table('user_statuses')->insert([
            'status' => boolval(random_int(0, 1)),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
}
