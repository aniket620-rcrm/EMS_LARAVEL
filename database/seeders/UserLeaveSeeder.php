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
                'user_id' => $userId->random()->id,
                'approval_status' => rand(0, 2),
                'approved_by' => 'Admin',
                'leave_start_date' => now()->addDays(rand(1, 15)),
                'leave_end_date' => now()->addDays(rand(15, 30)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('leaves')->insert([
                'user_id' => $userId->random()->id,
                'approval_status' => rand(0, 2),
                'approved_by' =>  'Admin' ,
                'leave_start_date' => now()->addDays(rand(1, 15)),
                'leave_end_date' => now()->addDays(rand(15, 30)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
