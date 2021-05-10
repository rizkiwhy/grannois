<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompetencyOfExpertise;

class CompetencyOfExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Kompetensi Keahlian';
        $data['subpage'] = 'Index';
        $data['app'] = 'Graduation Announcement Information System';

        // get all data kompetensi keahlian
        $data['competencyOfExpertise'] = CompetencyOfExpertise::all();

        return view(
            'pages.master.curriculum.competencyofexpertise.index',
            compact('data')
        );
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
            'label' => 'required',
            'active' => 'required',
        ]);

        // set active
        $active = $request->active === '1' ? true : false;

        // cari data kompetensi keahlian duplikat
        $duplicateCompetencyOfExpertise = CompetencyOfExpertise::where(
            'name',
            $request->name
        )
            ->orWhere('label', $request->label)
            ->get();

        // data kompetensi keahlian duplikat
        if ($duplicateCompetencyOfExpertise->count() > 0) {
            return redirect()
                ->route('competencyofexpertise.index')
                ->with(
                    'error_message',
                    'Entri duplikat ' . $request->name . '!'
                );
        } else {
            // create keahlian duplikat
            $createCompetencyOfExpertise = CompetencyOfExpertise::create([
                'name' => $request->name,
                'label' => $request->label,
                'active' => $active,
            ]);
            // create keahlian duplikat berhasil
            if ($createCompetencyOfExpertise) {
                return redirect()
                    ->route('competencyofexpertise.index')
                    ->with(
                        'success_message',
                        'Kompetensi Keahlian ' .
                            ucwords($createCompetencyOfExpertise->name) .
                            ' berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('competencyofexpertise.index')
                    ->with(
                        'error_message',
                        'Kompetensi Keahlian gagal ditambahkan!'
                    );
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
        $data['page'] = 'Kompetensi Keahlian';
        $data['subpage'] = 'Edit';
        $data['app'] = 'Graduation Announcement Information System';

        // get kompetensi keahlian yang akan diubah
        $data['competencyOfExpertise'] = CompetencyOfExpertise::find($id);

        return view(
            'pages.master.curriculum.competencyofexpertise.edit',
            compact('data')
        );
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
            'label' => 'required',
            'active' => 'required',
        ]);

        // set active
        $active = $request->active === '1' ? true : false;

        // cari data kompetensi keahlian duplikat
        $duplicateCompetencyOfExpertise = CompetencyOfExpertise::where('name', $request->name)->orWhere('label', $request->label)->get();

        // data kompetensi keahlian duplikat
        if ($duplicateCompetencyOfExpertise->count() > 1) {
            return redirect()
                ->route('competencyofexpertise.index')
                ->with(
                    'error_message',
                    'Entri duplikat ' . $request->name . '!'
                );
        } else {
            // update kompetensi keahlian
            $updateCompetencyOfExpertise = CompetencyOfExpertise::find($id)->update([
                'name' => $request->name,
                'active' => $active,
            ]);
            // create kompetensi keahlian berhasil
            if ($updateCompetencyOfExpertise) {
                return redirect()
                    ->route('competencyofexpertise.index')
                    ->with(
                        'success_message',
                        'Kompetensi Keahlian ' . ucwords($request->name) . ' berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route('competencyofexpertise.index')
                    ->with('error_message', 'Kompetensi Keahlian gagal diubah!');
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
        // cari kompetensi keahlian
        $competencyOfExpertise = CompetencyOfExpertise::withTrashed()->find(
            $id
        );

        // delete kompetensi keahlian
        $destroyCompetencyOfExpertise = $competencyOfExpertise->delete();

        // delete kompetensi keahlian berhasil
        if ($destroyCompetencyOfExpertise) {
            return redirect()
                ->route('competencyofexpertise.index')
                ->with(
                    'success_message',
                    'Kompetensi Keahlian ' .
                        $competencyOfExpertise->name .
                        ' berhasil dihapus!'
                );
        } else {
            return redirect()
                ->route('competencyofexpertise.index')
                ->with(
                    'error_message',
                    'Kompetensi Keahlian ' .
                        $competencyOfExpertise->name .
                        'gagal dihapus!'
                );
        }
    }
}
