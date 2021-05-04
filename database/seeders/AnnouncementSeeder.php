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
                'letter_number' => '498/I02/SMKN 11 BDG/KM/2021',
                'content' => '<p style="text-align: center;">Nomor: <span id="letterNumber">[letter_number]</span></p><br><p style="text-align: justify;">Kepala SMKN 11 Bandung sebagai Penanggung Jawab Penyelenggara Ujian Sekolah dan Ujian Nasional Tahun Pelajaran 2020/2021, berdasarkan peraturan Menteri Pendidikan dan Kebudayaan Republik Indonesia No. 3 tahun 2013, Prosedur Operasional Standar Penyelenggara Ujian Nasional Tahun Pelajaran 2020/2021 Badan Standar Nasional (BNSP) Nomor: 0022/P/BNSP/XI/2013 tanggal 30 November 2013 Serta hasil Rapat DInas Kepala Sekolah dengan Dewan Guru SMKN 11 Bandung pada tanggal 01 Mei 2021 pukul 09.00 WIB Tentang Keberhasilan kelas XII, dengan ini menyatakan bahwa:<table class="table table-sm table-borderless col-md-8 offset-md-2"><tbody><tr><td>Nama</td><td class="text-uppercase" id="studentName">: [student.name]</td></tr><tr><td>Kompetensi Keahlian</td><td id="competencyOfExpertiseName">: [competency_of_expertise.name]</td></tr><tr><td>NIS</td><td id="studentParentNumber">: [student_parent_number]</td></tr><tr><td>NISN</td><td id="nationalStudentParentNumber">: [national_student_parent_number]</td></tr></tbody></table><br><table class="table table-bordered col-md-6 offset-md-3"><tbody><tr><td class="text-center">LULUS</td><td class="text-center" style="text-decoration: line-through;">TIDAK LULUS</td></tr></tbody></table><br><p style="text-align: justify;">Dalam menempuh Ujian Sekolah dan Ujian Nasional Tahun Pelajaran <span id="schoolYear">[school_year]</span>.</p><table class="table table-sm table-borderless col-md-4 offset-md-8"><tbody><tr><td class="text-center">Bandung, <span id="publishDate">[publish_date]</span><br>Kepala Sekolah<br><br><br>Febiannisa Utami, S.Kom<br>NIP 19980226 202104 2 0001<br></td></tr></tbody></table>',
            ],
            [
                // 'id' => Str::uuid(),
                'activity_id' => 2,
                'publish_date' => '2022-04-27',
                'publisher' => 1,
                'note' => 'Kelulusan 2021/2022',
                'letter_number' => '500/I02/SMKN 11 BDG/KM/2021',
                'content' => '<p style="text-align: justify;">test<>',
            ],
        ];

        for ($i = 0; $i < count($dataAnnouncement); $i++) {
            Announcement::create($dataAnnouncement[$i]);
        }
    }
}
