<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Graduation;
use App\Models\Activity;
use App\Models\Student;
use App\Imports\GraduationImport;

class GraduationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Kelulusan';
        $data['subpage'] = 'Index';
        $data['app'] = 'Graduation Announcement Information System';

        // get all data graduation
        $data['graduation'] = Graduation::with([
            'activity.announcement',
            'student',
        ])->get();

        // get all data activty
        $data['activity'] = Activity::with([
            'activityType',
            'announcement',
            'graduation',
        ])
            ->where('activity_type_id', 1)
            ->get();

        // temp array studentId yang sudah digunakan
        $tempArrStudentId = [];

        // mencari & mengisi studentId yang sudah digunakan ke $tempArrStudentId
        for ($i = 0; $i < count($data['graduation']); $i++) {
            array_push($tempArrStudentId, $data['graduation'][$i]->student_id);
        }

        // get all data student yang belum dibuat kelulusan
        $data['student'] = Student::with([
            'competencyOfExpertise',
            'user',
            'graduation',
        ])
            ->whereNotIn('id', $tempArrStudentId)
            ->get();

        // return response()->json($data['graduation']);

        return view('pages.curriculum.graduation.index', compact('data'));
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
            'activityId' => 'required',
            'studentId' => 'required|unique:students,id',
            'status' => 'required',
            'certificate' => 'required',
        ]);

        // set status
        $status = $request->status === '1' ? 1 : 2;

        // get nis from student
        $student = Student::find($request->studentId);

        // create graduation
        $createGraduation = Graduation::create([
            'activity_id' => $request->activityId,
            'student_id' => $request->studentId,
            'status' => $status,
            'certificate' =>
                $student->student_parent_number .
                '-' .
                $request->file('certificate')->getClientOriginalName(),
        ]);

        if ($request->hasFile('certificate')) {
            $request->certificate->move(
                'certificate',
                $student->student_parent_number .
                    '-' .
                    $request->file('certificate')->getClientOriginalName()
            );
        }

        // create graduation berhasil
        if ($createGraduation) {
            return redirect()
                ->route('graduation.index')
                ->with(
                    'success_message',
                    ucwords(
                        $createGraduation->activity->activityType->name .
                            ' ' .
                            $createGraduation->activity->school_year .
                            ' / ' .
                            ++$createGraduation->activity->school_year
                    ) .
                        ' ' .
                        $createGraduation->student->user->name .
                        ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('graduation.index')
                ->with('error_message', 'Pengumuman gagal ditambahkan!');
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
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Kelulusan';
        $data['subpage'] = 'Show';
        $data['app'] = 'Graduation Announcement Information System';

        // get all data graduation
        $data['graduation'] = Graduation::where('student_id', $id)
            ->with(['activity.announcement', 'student'])
            ->get();

        // return response()->json($data['graduation']);
        return view('pages.curriculum.graduation.get', compact('data'));
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
        $data['page'] = 'Kelulusan';
        $data['subpage'] = 'Edit';
        $data['app'] = 'Graduation Announcement Information System';

        // get data graduation yang akan diubah
        $data['graduation'] = Graduation::find($id);

        // get all data graduation
        $dataGraduation = Graduation::all();

        // temp array studentId yang sudah digunakan
        $tempArrStudentId = [];

        // mencari & mengisi studentId yang sudah digunakan ke $tempArrStudentId
        for ($i = 0; $i < count($dataGraduation); $i++) {
            array_push($tempArrStudentId, $dataGraduation[$i]->student_id);
        }

        // get all data student yang belum dibuat kelulusan
        $data['student'] = Student::with([
            'competencyOfExpertise',
            'user',
            'graduation',
        ])
            ->whereNotIn('id', $tempArrStudentId)
            ->get();

        // get all data activty
        $data['activity'] = Activity::with([
            'activityType',
            'announcement',
            'graduation',
        ])
            ->where('activity_type_id', 1)
            ->get();

        return view('pages.curriculum.graduation.edit', compact('data'));
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
            'activityId' => 'required',
            'studentId' => 'required',
            'status' => 'required',
            // 'certificate' => 'required',
        ]);

        // set status
        $status = $request->status === '1' ? 1 : 2;

        // get nis from student
        $student = Student::find($request->studentId);

        // data graduation yang akan di ubah
        $graduation = Graduation::find($id);

        if ($request->hasFile('certificate')) {
            $request->certificate->move(
                'certificate',
                $student->student_parent_number .
                    '-' .
                    $request->file('certificate')->getClientOriginalName()
            );

            // update graduation
            $updateGraduation = $graduation->update([
                'activity_id' => $request->activityId,
                'student_id' => $request->studentId,
                'status' => $status,
                'certificate' =>
                    $student->student_parent_number .
                    '-' .
                    $request->file('certificate')->getClientOriginalName(),
            ]);
        } else {
            // update graduation
            $updateGraduation = $graduation->update([
                'activity_id' => $request->activityId,
                'student_id' => $request->studentId,
                'status' => $status,
            ]);
        }

        // update graduation berhasil
        if ($updateGraduation) {
            return redirect()
                ->route('graduation.index')
                ->with(
                    'success_message',
                    ucwords($graduation->activity->note) .
                        ' ' .
                        $graduation->student->user->name .
                        ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('graduation.index')
                ->with(
                    'error_message',
                    'Pengumuman ' .
                        $graduation->activity->note .
                        ' gagal ditambahkan!'
                );
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
        // cari graduation
        $graduation = Graduation::find($id);

        // temp student name
        $tempGraduationStudentName = $graduation->student->user->name;

        // delete graduation
        $destroyGraduation = $graduation->delete();

        // delete graduation berhasil
        if ($destroyGraduation) {
            return redirect()
                ->route('graduation.index')
                ->with(
                    'success_message',
                    'Kelulusan ' .
                        $tempGraduationStudentName .
                        ' berhasil dihapus!'
                );
        } else {
            return redirect()
                ->route('graduation.index')
                ->with(
                    'error_message',
                    'Kelulusan ' . $tempGraduationStudentName . 'gagal dihapus!'
                );
        }
    }

    public function import(Request $request)
    {
        // import data graduation
        try {
            $importGraduationData = \Excel::import(
                new GraduationImport(),
                $request->file('graduationData')
            );
        } catch (QueryException $qe) {
            // import data graduation gagal;
            $errorCode = $qe->errorInfo[1];
            if ($errorCode == 1062) {
                $errorMessage = str_replace("'", '', $qe->errorInfo[2]);
                return redirect()
                    ->route('graduation.index')
                    ->with('error_message', $errorMessage);
            }
            if ($errorCode == 1048) {
                $errorMessage = str_replace("'", '', $qe->errorInfo[2]);
                return redirect()
                    ->route('graduation.index')
                    ->with('error_message', $errorMessage);
            }
        }

        // import data graduation berhasil
        // if ($importGraduationData) {
        return redirect()
            ->route('graduation.index')
            ->with('success_message', 'Data Kelulusan berhasil diimport!');
        // }

        // import data student gagal
        // return redirect()
        //     ->route('student.index')
        //     ->with('error_message', 'Data Siswa gagal diimport');
    }
}
