<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Graduation;

class GraduationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataGraduation = [
            [
                // 'id' => Str::uuid(),
                'activity_id' => 1,
                'student_id' => 1,
                'status' => 1,
                'certificate' => '121310083-1.jpg',
            ],
            [
                // 'id' => Str::uuid(),
                'activity_id' => 2,
                'student_id' => 2,
                'status' => 1,
                'certificate' => '121310084-1117.jpg',
            ],
        ];

        for ($i = 0; $i < count($dataGraduation); $i++) {
            Graduation::create($dataGraduation[$i]);
        }
    }
}
