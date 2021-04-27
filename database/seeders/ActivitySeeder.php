<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Str;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataActivity = [
            [
                // 'id' => Str::uuid(),
                'activity_type_id' => 1,
                'school_year' => 2020,
                'start_date' => '2021-04-27',
                'end_date' => '2021-04-27',
                'note' => 'Kelulusan 2020/2021'
            ],
        ];

        for ($i = 0; $i < count($dataActivity); $i++) {
            Activity::create($dataActivity[$i]);
        }
    }
}
