<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Graduation;
use App\Models\Activity;
use App\Models\Student;

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
        ])->get();

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

        // return response()->json($data);

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
        // dd($request->all());
        // validasi data request
        $request->validate([
            'activityId' => 'required',
            'studentId' => 'required',
            'status' => 'required',
            'certificate' => 'required',
        ]);

        if ($request->status === '1') {
            $request->status = 1;
            // dd($request->status);
        }

        // nis
        $student = Student::find($request->studentId);
        // dd($student->student_parent_number);

        //
        // dd($request->file('certificate'));

        // create graduation
        $createGraduation = Graduation::create([
            'activity_id' => $request->activityId,
            'student_id' => $request->studentId,
            'status' => $request->status,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
