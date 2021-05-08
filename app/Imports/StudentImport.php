<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            # code...
            $createUser = user::create([
                'role_id' => $row['role_id'],
                'name' => ucwords($row['name']),
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'active' => $row['active'],
            ]);

            $createStudent = Student::create([
                'user_id' => $createUser->id,
                'place_of_birth' => $row['tempat_lahir'],
                'date_of_birth' => gmdate(
                    'Y-m-d',
                    ($row['tanggal_lahir'] - 25569) * 86400
                ),
                'student_parent_number' => $row['nis'],
                'national_student_parent_number' => $row['nisn'],
                'competency_of_expertise_id' => $row['kompetensi_keahlian_id'],
            ]);
        }
    }
}
