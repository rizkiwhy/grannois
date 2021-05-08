<?php

namespace App\Imports;

// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    // public function collection(Collection $collection)
    // {
    //     foreach ($collection as $key => $row) {
    //         User::create([
    //             'id' => $row['id'],
    //             'role_id' => $row['role_id'],
    //             'name' => ucwords($row['name']),
    //             'email' => $row['email'],
    //             'password' => Hash::make($row['password']),
    //             'active' => $row['active'],
    //         ]);
    //     }
    // }
    public function model(array $row)
    {
        return new User([
            'id' => $row['id'],
            'role_id' => $row['role_id'],
            'name' => ucwords($row['name']),
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'active' => $row['active'],
        ]);
    }
}
