<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\User;
use App\Models\Role;
use App\Models\Student;
use App\Imports\UserImport;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'User';
        $data['subpage'] = 'Index';
        $data['app'] = 'Graduation Announcement Information System';

        // get all data user
        $data['user'] = User::with(['role'])->get();

        // get all date role
        $data['role'] = Role::all();

        return view('pages.master.app.user.index', compact('data'));
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
        dd($request->all());

        // validasi data request
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5',
            'roleId' => 'required',
            'active' => 'required',
        ]);

        // create user
        $createUser = User::create([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->roleId,
            'active' => $request->active,
        ]);

        // check role (student)
        if ($request->roleId == 3) {
            // get latest user created
            $user = User::orderByDesc('created_at')->first();

            // create student
            $createStudent = Student::create([
                'user_id' => $user->id,
            ]);
        }

        // create user berhasil
        if ($createUser) {
            return redirect()
                ->route('user.index')
                ->with(
                    'success_message',
                    'User ' .
                        ucwords($createUser->name) .
                        ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('user.index')
                ->with('error_message', 'User gagal ditambahkan!');
        }
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
        $data['page'] = 'User';
        $data['subpage'] = 'Edit';
        $data['app'] = 'Graduation Announcement Information System';

        // get all data user
        $data['user'] = User::with(['role'])->find($id);

        // get all date role
        $data['role'] = Role::all();

        return view('pages.master.app.user.edit', compact('data'));
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
        dd($request->all());

        // cari user yang akan diubah
        $user = User::find($id);

        $tempRoleId = $user->role_id;

        // cari data user duplikat
        $duplicateUser = User::where('name', $request->name)
            ->orWhere('email', $request->email)
            ->get();

        // data user duplikat
        if ($duplicateUser->count() > 1) {
            return redirect()
                ->route('user.index')
                ->with(
                    'error_message',
                    'Entri duplikat ' .
                        $request->name .
                        ' or ' .
                        $request->email .
                        '!'
                );
        }

        // password & password_confirmation tidak diisi
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
            ]);

            // update user
            $updateUser = $user->update([
                'name' => ucwords($request->name),
                'email' => $request->email,
                // 'password' => Hash::make($request->password),
                'role_id' => $request->roleId,
                'active' => $request->active,
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
            ]);

            // update user
            $updateUser = $user->update([
                'name' => ucwords($request->name),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->roleId,
                'active' => $request->active,
            ]);
        }

        // get latest user updated
        $updatedUser = User::orderByDesc('updated_at')->first();

        // ubah menjadi student (create data student)
        if ($request->roleId == 3 && $tempRoleId != 3) {
            // create student
            $createStudent = Student::create([
                'user_id' => $updatedUser->id,
            ]);
        }

        // ubah menjadi bukan student (delete data student)
        if ($request->role_id != 3 && $tempRoleId == 3) {
            // delete student
            $createStudent = $user->student()->delete();
        }

        // update user berhasil
        if ($updateUser) {
            return redirect()
                ->route('user.index')
                ->with(
                    'success_message',
                    'User ' . ucwords($request->name) . ' berhasil diubah!'
                );
        }
        return redirect()
            ->route('user.index')
            ->with('error_message', 'User gagal diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // cari user
        $user = User::find($id);

        //temp user name
        $tempUserName = $user->name;

        // delete user
        $destroyUser = $user->delete();

        // delete siswa
        $destroyStudent = $user->student->delete();

        // delete user berhasil
        if ($destroyUser) {
            return redirect()
                ->route('user.index')
                ->with(
                    'success_message',
                    'User ' . $tempUserName . ' berhasil dihapus!'
                );
        } else {
            return redirect()
                ->route('user.index')
                ->with(
                    'error_message',
                    'User ' . $tempUserName . 'gagal dihapus!'
                );
        }
    }

    public function import(Request $request)
    {
        // import data user
        try {
            $importUserData = \Excel::import(
                new UserImport(),
                $request->file('userData')
            );
        } catch (QueryException $qe) {
            // import data user gagal

            // // mysql
            // $errorCode = $qe->errorInfo[1];
            // $errorMessage = str_replace("'", '', $qe->errorInfo[2]);

            // // duplicate
            // if ($errorCode == 1062) {
            //     return redirect()
            //         ->route('user.index')
            //         ->with('error_message', $errorMessage);
            // }

            // // nulll
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

        // import data user berhasil
        return redirect()
            ->route('user.index')
            ->with('success_message', 'Data User berhasil diimport!');
    }
}
