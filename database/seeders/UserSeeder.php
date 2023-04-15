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

        $bios = [
            "Experienced software engineer with a focus on web development and a passion for creating great user experiences.",
            "Versatile full-stack developer with a strong background in PHP, Laravel, and Vue.js.",
            "Highly skilled front-end developer with expertise in React, Redux, and GraphQL.",
            "Motivated and detail-oriented web designer with a proven track record of delivering high-quality work.",
            "Creative and collaborative UI/UX designer with experience in designing user interfaces for web and mobile apps.",
            "Experienced product manager with a strong background in agile development and user-centered design.",
            "Skilled copywriter with a passion for crafting compelling stories and engaging content.",
            "Experienced marketing professional with a track record of developing successful campaigns and driving growth.",
            "Organized and detail-oriented project manager with experience leading cross-functional teams and delivering complex projects on time and within budget.",
            "Experienced human resources professional with a focus on recruitment, talent development, and employee engagement.",
            "Results-driven sales professional with a track record of exceeding targets and building strong relationships with clients.",
            "Experienced financial analyst with expertise in financial modeling, forecasting, and data analysis.",
            "Highly motivated customer service representative with a passion for helping customers and resolving issues.",
            "Skilled administrative assistant with experience managing calendars, scheduling meetings, and coordinating events.",
            "Experienced educator with a passion for teaching and a track record of inspiring students to achieve their full potential."
        ];


        for ($i = 1; $i <= 10; $i++) {
            $bio = $faker->randomElement($bios);
            
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'phone'=> $faker->phoneNumber(),
                'password'=> bcrypt('password'),
                'image_path'=>$faker->imageUrl(),
                'Bio' => $bio,
                'city' => $faker->city(),
                'user_role_id' => rand(2,3),
                'user_status_id' => $user_status->random()->id,
                'joining_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
}