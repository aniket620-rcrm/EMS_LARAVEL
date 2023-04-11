<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserStatusSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(UserLeaveSeeder::class);
        $this->call(TotalLeaveSeeder::class);
        $this->call(UserSalary::class);
        $this->call(UserSalaryHistorySeeder::class);
        $this->call(UserSeeder::class);
    }
}
