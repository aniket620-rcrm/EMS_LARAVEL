<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

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
        $salary_history = \App\Models\SalaryHistory::all();
        $salary = \App\Models\Salary::all();
        $leave = \App\Models\Leave::all();
        $leave_count = \App\models\TotalLeave::all();

<<<<<<< HEAD
        $faker = Faker::create();

=======
        $faker= Faker::create();
>>>>>>> 0f7915fa26ed69fc1a2a129a21dffee177862ea1
        for ($i = 1; $i <= 10; $i++) {
            
            DB::table('users')->insert([
<<<<<<< HEAD
                'name' => Str::random(10),
                'phoneNumber'=> $faker->phoneNumber(),
                'email' => Str::random(10).'@example.com',
=======
                'name' => $faker->name(),
                'email' => $faker->email(),
>>>>>>> 0f7915fa26ed69fc1a2a129a21dffee177862ea1
                'password'=> bcrypt('password'),
                'roles_id' => $role->random()->id,
                'user_statuses_id' => $user_status->random()->id,
                'salary_history_id'=> $salary_history->random()->id,
                'salary_id'=>$salary->random()->id,
                'leave_id' => $leave->random()->id,
                'leave_count_id' => $leave->random()->id,
                'joining_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
}