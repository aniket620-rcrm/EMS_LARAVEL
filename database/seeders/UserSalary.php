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
        $userStatusId = \App\Models\UserStatus::all();  
        $roleId = \App\Models\roles::all(); 
       
        for ($i = 1; $i <= 10; $i++) {     
            
            DB::table('salaries')->insert([
                'users_id' => $userId->random()->id,
                'user_statuses_id' => $userStatusId->random()->id,
                'roles_id' => $roleId->random()->id,
                'paid_status' => rand(0, 1),
                'leave_count' => rand(1, 10),
                'tax' => rand(1000, 10000),
                'deductions' => rand(1000, 10000),
                'payable_salary' => rand(10000, 50000),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
