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
        $this->call(RoleSeeder::class);
        $this->call(CompetencyOfExpertiseSeeder::class);
        $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();
        $this->call(StudentSeeder::class);
        $this->call(ActivityTypeSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(GraduationSeeder::class);

    }
}
