<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLeaveSeeder extends Seeder
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
           
            DB::table('leaves')->insert([
                // 'users_id' => $userId->random()->id,
                'approval_status' => rand(0, 1),
                'approved_by' => rand(0, 1) ? 'Admin' : 'Manager',
                'leave_start_date' => now()->addDays(rand(1, 30)),
                'leave_end_date' => now()->addDays(rand(1, 30)),
                'month' => rand(1, 12),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
