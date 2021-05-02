<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Role';
        $data['subpage'] = 'Index';
        $data['app'] = 'Graduation Announcement Information System';

        // get all data role
        $data['role'] = Role::all();

        return view('pages.master.app.role.index', compact('data'));
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
            'name' => 'required',
            'active' => 'required',
        ]);

        // cari data role duplikat
        $duplicateRole = Role::where('name', $request->name)->get();

        // data activity role
        if ($duplicateRole->count() > 0) {
            return redirect()
                ->route('role.index')
                ->with(
                    'error_message',
                    'Entri duplikat ' . $request->name . '!'
                );
        } else {
            // create role
            $createRole = Role::create([
                'name' => $request->name,
                'active' => $request->active,
            ]);
            // create role berhasil
            if ($createRole) {
                return redirect()
                    ->route('role.index')
                    ->with(
                        'success_message',
                        'Role ' .
                            ucwords($createRole->name) .
                            ' berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('role.index')
                    ->with('error_message', 'Role gagal ditambahkan!');
            }
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
        $data['page'] = 'Role';
        $data['subpage'] = 'Edit';
        $data['app'] = 'Graduation Announcement Information System';

        // get role yang akan diubah
        $data['role'] = Role::find($id);

        return view('pages.master.app.role.edit', compact('data'));
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
        // validasi data request
        $request->validate([
            'name' => 'required',
            'active' => 'required',
        ]);

        // cari data role duplikat
        $duplicateRole = Role::where('name', $request->name)->get();

        // data activity role
        if ($duplicateRole->count() > 1) {
            return redirect()
                ->route('role.index')
                ->with(
                    'error_message',
                    'Entri duplikat ' . $request->name . '!'
                );
        } else {
            // update role
            $updateRole = Role::find($id)->update([
                'name' => $request->name,
                'active' => $request->active,
            ]);
            // create role berhasil
            if ($updateRole) {
                return redirect()
                    ->route('role.index')
                    ->with(
                        'success_message',
                        'Role ' .
                            ucwords($request->name) .
                            ' berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route('role.index')
                    ->with('error_message', 'Role gagal diubah!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // cari role
        $role = Role::withTrashed()->find($id);

        // delete role
        $destroyRole = $role->delete();

        // delete role berhasil
        if ($destroyRole) {
            return redirect()
                ->route('role.index')
                ->with(
                    'success_message',
                    'Role ' . $role->name . ' berhasil dihapus!'
                );
        } else {
            return redirect()
                ->route('role.index')
                ->with(
                    'error_message',
                    'Role ' . $role->name . 'gagal dihapus!'
                );
        }
    }
}
