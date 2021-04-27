<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataAnnouncement = [
            [
                // 'id' => Str::uuid(),
                'activity_id' => 1,
                'publish_date' => '2021-04-27',
                'publisher' => 1,
                'note' => 'Kelulusan 2020/2021',
            ],
            [
                // 'id' => Str::uuid(),
                'activity_id' => 2,
                'publish_date' => '2022-04-27',
                'publisher' => 1,
                'note' => 'Kelulusan 2021/2022',
            ],
        ];

        for ($i = 0; $i < count($dataAnnouncement); $i++) {
            Announcement::create($dataAnnouncement[$i]);
        }
    }
}
