<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataRole = [
            [
                'name' => 'Administrator',
                'active' => true,
            ],
            [
                'name' => 'Curriculum Staff',
                'active' => true,
            ],
            [
                'name' => 'Student',
                'active' => true,
            ],
        ];
        for ($i = 0; $i < count($dataRole); $i++) {
            Role::create($dataRole[$i]);
        }
    }
}
