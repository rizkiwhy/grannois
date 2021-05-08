<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use App\Models\Student;
use App\Models\Graduation;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Validator;

class GraduationImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // dd($collection);

        $collection = $collection->toArray();

        foreach ($collection as $key => $row) {
            // cek validasi data
            $validator = Validator::make(
                $row,
                $this->rules(),
                $this->validationMessages()
            );

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
                'national_student_parent_number' => substr($row['nisn'], 1),
                'competency_of_expertise_id' => $row['kompetensi_keahlian_id'],
            ]);

            $createGratudation = Graduation::create([
                'student_id' => $createStudent->id,
                'activity_id' => $row['activity_id'],
                'status' => $row['status'],
                'certificate' => $row['certificate'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
        ];
    }

    public function validationMessages()
    {
        return [
            'name.unique' => trans('name_must_be_unique'),
            'email.unique' => trans('email_must_be_unique'),
        ];
    }
}
