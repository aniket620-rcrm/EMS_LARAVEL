<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class UserSalary extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userId = \App\Models\User::all();
        // $userStatusId = \App\Models\UserStatus::all();  
        // $roleId = \App\Models\roles::all(); 
       
        for ($i = 1; $i <= 10; $i++) {     
            
            DB::table('salaries')->insert([
                'user_id' => $userId->random()->id,
                'paid_status' => rand(0, 1),
                'payable_salary' => rand(100000, 700000),
                'leave_count'=>rand(1,15),
                'month'=>rand(1,12),
                'year'=>rand(2021,2099),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
