<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Student;

class StudentSeeder extends Seeder
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
                'name' => 'Rizki',
                'email' => 'rizki@gais.com',
                'password' => bcrypt('gais123'),
                'role_id' => 3,
                'active' => true,
            ],
            [
                // 'id' => Str::uuid(),
                'name' => 'Ica',
                'email' => 'ica@gais.com',
                'password' => bcrypt('gais123'),
                'role_id' => 3,
                'active' => true,
            ],
        ];

        $dataStudent = [
            [
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1997-11-17',
                'student_parent_number' => '121310083',
                'national_student_parent_number' => '9978773329',
                'competency_of_expertise_id' => 6,
            ],
            [
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1998-02-26',
                'student_parent_number' => '121310084',
                'national_student_parent_number' => '9978773328',
                'competency_of_expertise_id' => 6,
            ],
        ];

        for ($i = 0; $i < count($dataUser); $i++) {
            $createUser = User::create($dataUser[$i]);
            Student::create([
                'user_id' => $createUser->id,
                'place_of_birth' => $dataStudent[$i]['place_of_birth'],
                'date_of_birth' => $dataStudent[$i]['date_of_birth'],
                'student_parent_number' =>
                    $dataStudent[$i]['student_parent_number'],
                'national_student_parent_number' =>
                    $dataStudent[$i]['national_student_parent_number'],
                'competency_of_expertise_id' =>
                    $dataStudent[$i]['competency_of_expertise_id'],
            ]);
            // ->where('user_id', $createUser->id)
            // ->update($dataStudent[$i]);
        }
    }
}
