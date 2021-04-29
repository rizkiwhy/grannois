<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityType;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Kegiatan';
        $data['subpage'] = 'Index';
        $data['app'] = 'Graduation Announcement Information System';

        // get all data activity
        $data['activity'] = Activity::with([
            'activityType',
            'announcement',
            'graduation',
        ])->get();

        // get all data activity type
        $data['activityType'] = ActivityType::all();

        // set tahun ajaran
        $month = date('m');
        $year = date('Y');
        $data['startYear'] = $month <= 6 ? --$year : $year;
        $data['endYear'] = ++$year;

        // dd($retVal);

        return view('pages.curriculum.activity.index', compact('data'));
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
        // dd($request->all());
        // validasi data request
        $request->validate([
            'activityTypeId' => 'required',
            'schoolYear' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        // cari data tipe activity untuk keperluan isi kolom note table activity
        $activityType = ActivityType::find($request->activityTypeId);

        // temp shoolYear
        $tempSchoolYear = $request->schoolYear;

        // format note
        $note =
            $activityType->name .
            ' ' .
            $request->schoolYear .
            '/' .
            ++$request->schoolYear;

        // cari data activity duplikat
        $duplicateActivity = Activity::where('note', $note)->get();

        // data activity duplicate
        if ($duplicateActivity->count() > 0) {
            return redirect()
                ->route('activity.index')
                ->with('error_message', 'Entri duplikat ' . $note . '!');
        } else {
            // create activity
            $createActivity = Activity::create([
                'activity_type_id' => $request->activityTypeId,
                'school_year' => $tempSchoolYear,
                'start_date' => $request->startDate,
                'end_date' => $request->endDate,
                'note' => $note,
            ]);
            // create activity berhasil
            if ($createActivity) {
                return redirect()
                    ->route('activity.index')
                    ->with(
                        'success_message',
                        'Kegiatan ' .
                            ucwords($createActivity->note) .
                            ' berhasil ditambahkan!'
                    );
            } else {
                return redirect()
                    ->route('activity.index')
                    ->with('error_message', 'Kegiatan gagal ditambahkan!');
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
        $data['page'] = 'Kegiatan';
        $data['subpage'] = 'Index';
        $data['app'] = 'Graduation Announcement Information System';

        // get activity yang akan diubah
        $data['activity'] = Activity::find($id);

        // get all data activity type
        $data['activityType'] = ActivityType::all();

        // set tahun ajaran
        $month = date('m');
        $year = date('Y');
        $data['startYear'] = $month <= 6 ? --$year : $year;
        $data['endYear'] = ++$year;

        return view('pages.curriculum.activity.edit', compact('data'));
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
            'activityTypeId' => 'required',
            'schoolYear' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        // cari data tipe activity untuk keperluan isi kolom note table activity
        $activityType = ActivityType::find($request->activityTypeId);

        // format note
        $note =
            $activityType->name .
            ' ' .
            $request->schoolYear .
            '/' .
            ++$request->schoolYear;

        // cari data activity duplikat
        $duplicateActivity = Activity::where('note', $note)->get();

        // data activity duplicate
        if ($duplicateActivity->count() > 1) {
            return redirect()
                ->route('activity.index')
                ->with('error_message', 'Entri duplikat ' . $note . '!');
        } else {
            // update activity
            $updateActivity = Activity::find($id)->update([
                'activity_type_id' => $request->activityTypeId,
                'school_year' => $request->schoolYear,
                'start_date' => $request->startDate,
                'end_date' => $request->endDate,
                'note' => $note,
            ]);
            // update activity berhasil
            if ($updateActivity) {
                return redirect()
                    ->route('activity.index')
                    ->with(
                        'success_message',
                        'Kegiatan ' . $note . ' berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route('activity.index')
                    ->with(
                        'error_message',
                        'Kegiatan ' . $note . 'gagal diubah!'
                    );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        // cari activity
        $activity = Activity::find($request->deleteId);
        // dd($activity);

        // delete activity
        $destroyActivity = $activity->delete();

        // delete activity berhasil
        if ($destroyActivity) {
            return redirect()
                ->route('activity.index')
                ->with(
                    'success_message',
                    'Kegiatan ' . $request->deleteNote . ' berhasil dihapus!'
                );
        } else {
            return redirect()
                ->route('activity.index')
                ->with(
                    'error_message',
                    'Kegiatan ' . $request->deleteNote . 'gagal dihapus!'
                );
        }
    }
}
