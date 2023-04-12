<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
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

        
        $role = \App\Models\UserRole::all();
        $user_status = \App\Models\UserStatus::all();
        $salary = \App\Models\Salary::all();
        $leave = \App\Models\Leave::all();

        $faker= Faker::create();
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'phone'=> $faker->phoneNumber(),
                'password'=> bcrypt('password'),
                'image_path'=>$faker->imageUrl(),
                'user_role_id' => rand(2,3),
                'user_status_id' => $user_status->random()->id,
                'joining_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
}