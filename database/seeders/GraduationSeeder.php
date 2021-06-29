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
            // [
            //     'activity_id' => 1,
            //     'student_id' => 1,
            //     'status' => 1,
            //     'certificate' => '121310083-1.jpg',
            // ],
            // [
            //     'activity_id' => 2,
            //     'student_id' => 2,
            //     'status' => 1,
            //     'certificate' => '121310084-1117.jpg',
            // ],
            // [
            //     'activity_id' => 2,
            //     'student_id' => 3,
            //     'status' => 1,
            //     'certificate' => '1706510097-RPL1_27_SAEPUL.pdf',
            // ],
            // [
            //     'activity_id' => 1,
            //     'student_id' => 4,
            //     'status' => 1,
            //     'certificate' => '1706510098-RPL1_28_SALMA.pdf',
            // ],
            // [
            //     'activity_id' => 1,
            //     'student_id' => 5,
            //     'status' => 1,
            //     'certificate' => '1706510103-RPL1_30_SYAHRUNIMAH.pdf',
            // ],
        ];

        for ($i = 0; $i < count($dataGraduation); $i++) {
            Graduation::create($dataGraduation[$i]);
        }
    }
}
