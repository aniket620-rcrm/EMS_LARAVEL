<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TotalLeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = \App\Models\User::all();
        for ($i = 1; $i <= 10; $i++) {
                DB::table('total_leaves')->insert([
                // 'users_id' => $userId->random()->id,
                'leave_count' => rand(1, 10),
                'month' => rand(1, 12),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
