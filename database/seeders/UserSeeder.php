<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataUser = [
            [
                // 'id' => Str::uuid(),
                'name' => 'Administrator',
                'email' => 'admin@gais.com',
                'password' => bcrypt('rfVgbhu3#4$6^8*'),
                'role_id' => 1,
                'active' => true,
            ],
            [
                // 'id' => Str::uuid(),
                'name' => 'Curriculum Staff',
                'email' => 'currstaff@gais.com',
                'password' => bcrypt('tgBhnji4$5%7&9('),
                'role_id' => 2,
                'active' => true,
            ],
        ];

        for ($i = 0; $i < count($dataUser); $i++) {
            User::create($dataUser[$i]);
        }
    }
}
