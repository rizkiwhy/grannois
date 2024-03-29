<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Student;
use App\Models\User;
use App\Models\Role;
use App\Models\CompetencyOfExpertise;
use App\Imports\StudentImport;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Siswa';
        $data['subpage'] = 'Index';
        $data['app'] = 'Graduation Announcement Information System';

        // get all data student
        $data['student'] = Student::with([
            'user',
            'competencyOfExpertise',
        ])->get();

        // get data role student
        $data['role'] = Role::where('name', 'Student')->first();

        // get all data kompetensi keahlian
        $data['competencyOfExpertise'] = CompetencyOfExpertise::all();

        return view('pages.master.curriculum.student.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi data request
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5',
            'roleId' => 'required',
            'active' => 'required',
            'placeOfBirth' => 'required',
            'dateOfBirth' => 'required',
            'studentParentNumber' => 'required',
            'nationalStudentParentNumber' => 'required',
        ]);

        // set active
        $active = $request->active === '1' ? true : false;

        // create user
        $createUser = User::create([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->roleId,
            'active' => $active,
        ]);

        // check role (student)
        if ($request->roleId == 3) {
            // get latest user created
            $user = User::orderByDesc('created_at')->first();

            // create student
            $createStudent = Student::create([
                'user_id' => $user->id,
                'place_of_birth' => $request->placeOfBirth,
                'date_of_birth' => $request->dateOfBirth,
                'student_parent_number' => $request->studentParentNumber,
                'national_student_parent_number' =>
                    $request->nationalStudentParentNumber,
                'competency_of_expertise_id' =>
                    $request->competencyOfExpertiseId,
            ]);
        }

        // create student berhasil
        if ($createUser) {
            return redirect()
                ->route('student.index')
                ->with(
                    'success_message',
                    'Siswa ' .
                        ucwords($createUser->name) .
                        ' berhasil ditambahkan!'
                );
        }

        // create student gagal
        return redirect()
            ->route('student.index')
            ->with('error_message', 'Siswa gagal ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Siswa';
        $data['subpage'] = 'Edit';
        $data['app'] = 'Graduation Announcement Information System';

        // get data siswa yang akan diubah
        $data['student'] = Student::with([
            'user',
            'competencyOfExpertise',
        ])->find($id);

        // get data role student
        $data['role'] = Role::where('name', 'Student')->first();

        // get all data kompetensi keahlian
        $data['competencyOfExpertise'] = CompetencyOfExpertise::all();

        return view('pages.master.curriculum.student.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // cari siswa yang akan diubah
        $student = Student::find($id);

        // set active
        $active = $request->active === '1' ? true : false;

        $tempRoleId = $student->user->role_id;

        // cari data user duplikat
        $duplicateUser = User::where('name', $request->name)
            ->orWhere('email', $request->email)
            ->get();

        // data user duplikat
        if ($duplicateUser->count() > 1) {
            return redirect()
                ->route('student.index')
                ->with(
                    'error_message',
                    'Entri duplikat ' .
                        $request->name .
                        ' or ' .
                        $request->email .
                        '!'
                );
        }

        if (
            $request->password == null &&
            $request->password_confirmation == null
        ) {
            // validasi data request
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'roleId' => 'required',
                'active' => 'required',
                'placeOfBirth' => 'required',
                'dateOfBirth' => 'required',
                'studentParentNumber' => 'required',
                'nationalStudentParentNumber' => 'required',
            ]);

            // update user
            $updateUser = $student->user->update([
                'name' => ucwords($request->name),
                'email' => $request->email,
                'role_id' => $request->roleId,
                'active' => $active,
            ]);
        } else {
            // validasi data request
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:5|confirmed',
                'password_confirmation' => 'required|min:5',
                'roleId' => 'required',
                'active' => 'required',
                'placeOfBirth' => 'required',
                'dateOfBirth' => 'required',
                'studentParentNumber' => 'required',
                'nationalStudentParentNumber' => 'required',
            ]);

            // update user
            $updateUser = $student->user->update([
                'name' => ucwords($request->name),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->roleId,
                'active' => $active,
            ]);
        }

        // update siswa
        $student->update([
            'place_of_birth' => $request->placeOfBirth,
            'date_of_birth' => $request->dateOfBirth,
            'student_parent_number' => $request->studentParentNumber,
            'national_student_parent_number' =>
                $request->nationalStudentParentNumber,
            'competency_of_expertise_id' => $request->competencyOfExpertiseId,
        ]);

        // update student berhasil
        if ($updateUser) {
            return redirect()
                ->route('student.index')
                ->with(
                    'success_message',
                    'Siswa ' . ucwords($request->name) . ' berhasil diubah!'
                );
        }

        // update student gagal
        return redirect()
            ->route('student.index')
            ->with('error_message', 'Siswa gagal diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // cari student
        $student = Student::find($id);

        // temp student name
        $tempStudentName = $student->user->name;

        // delete siswa
        $destroyStudent = $student->delete();

        // delete user
        $destroyUser = $student->user->delete();

        // delete siswa berhasil
        if ($destroyStudent) {
            return redirect()
                ->route('student.index')
                ->with(
                    'success_message',
                    'Siswa ' . $tempStudentName . ' berhasil dihapus!'
                );
        }
        return redirect()
            ->route('student.index')
            ->with(
                'error_message',
                'Siswa ' . $tempStudentName . 'gagal dihapus!'
            );
    }

    public function import(Request $request)
    {
        // import data student
        try {
            $importStudentData = \Excel::import(
                new StudentImport(),
                $request->file('studentData')
            );
        } catch (QueryException $qe) {
            // import data student gagal;

            // // mysql
            // $errorCode = $qe->errorInfo[1];
            // $errorMessage = str_replace("'", '', $qe->errorInfo[2]);

            // // duplicate
            // if ($errorCode == 1062) {
            //     return redirect()
            //         ->route('student.index')
            //         ->with('error_message', $errorMessage);
            // }

            // // null
            // if ($errorCode == 1048) {
            //     return redirect()
            //         ->route('graduation.index')
            //         ->with('error_message', $errorMessage);
            // }

            // pgsql
            $errorCode = $qe->errorInfo[0];
            $errorMessage = explode(
                "\n",
                str_replace("'", '', $qe->errorInfo[2])
            );

            // duplicate
            if ($errorCode == 23505) {
                return redirect()
                    ->route('graduation.index')
                    ->with('error_message', $errorMessage[0]);
            }

            // null
            if ($errorCode == 23502) {
                return redirect()
                    ->route('graduation.index')
                    ->with('error_message', $errorMessage[0]);
            }
        }
        

        // import data student berhasil
        return redirect()
            ->route('student.index')
            ->with('success_message', 'Data Siswa berhasil diimport!');
    }
}
