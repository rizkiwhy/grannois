<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityType;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataActivityType = [
            [
                'name' => 'Kelulusan',
                'active' => true,
            ],
            [
                'name' => 'Ujian Sekolah',
                'active' => true,
            ],
        ];

        for ($i = 0; $i < count($dataActivityType); $i++) {
            ActivityType::create($dataActivityType[$i]);
        }
    }
}
