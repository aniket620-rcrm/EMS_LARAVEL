<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSalaryHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = \App\Models\User::all(); 
        $salaryId = \App\Models\Salary::all(); 
        for ($i = 1; $i <= 10; $i++) {
           
            DB::table('salary_histories')->insert([
                'users_id' => $userId->random()->id,
                'salary_id' => $salaryId->random()->id,
                'month' => rand(1, 12),
                'year' => rand(2010, 2023),
                'received_salary' => rand(10000, 50000),
                
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
