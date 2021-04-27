<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompetencyOfExpertise;

class CompetencyOfExpertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataCompentencyOfExpertise = [
            [
                'name' => 'Akuntansi dan Keuangan Lembaga',
                'label' => 'AKL',
                'active' => true,
            ],
            [
                'name' => 'Bisnis Daring dan Pemasaran',
                'label' => 'BDP',
                'active' => true,
            ],
            [
                'name' => 'Multimedia',
                'label' => 'MM',
                'active' => true,
            ],
            [
                'name' => 'Otomatisasi dan Tata Kelola Perkantoran',
                'label' => 'OTKP',
                'active' => true,
            ],
            [
                'name' => 'Rekayasa Perangkat Lunak',
                'label' => 'RPL',
                'active' => true,
            ],
            [
                'name' => 'Teknik Komputer dan Jaringan',
                'label' => 'TKJ',
                'active' => true,
            ],
        ];
        for ($i = 0; $i < count($dataCompentencyOfExpertise); $i++) {
            CompetencyOfExpertise::create($dataCompentencyOfExpertise[$i]);
        }
    }
}
