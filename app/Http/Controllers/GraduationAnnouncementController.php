<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class GraduationAnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['layout'] = 'layouts.grannouncement';
        $data['page'] = 'Pengumuman Kelulusan';
        $data['greetingWord'] = 'Selamat datang';
        $data['school'] = 'di SMKN 11 Bandung';
        $data['app'] = 'Grannois';

        $data['student'] = Student::all();

        return view('pages.grannouncement', compact('data'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' =>
                    'Could not connect to the database. Please check your configuration.',
                ],
                501
            );
        }

        $dataStudent = Student::where('student_parent_number', $id)
            ->with([
                'graduation.activity.announcement',
                'competencyOfExpertise',
                'user',
            ])
            ->first();

        // data siswa tidak ditemukan
        if ($dataStudent === null) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Data siswa tidak ditemukan',
                ],
                200
            );
        }

        // data kelulusan ditemukan
        if ($dataStudent->graduation) {
            // data kelulusan sudah dipublikasi
            if (
                date('Y-m-d') >=
                $dataStudent->graduation->activity->announcement[0]
                ->publish_date
            ) {
                // dd($dataStudent->graduation);
                // data nilai tidak lengkap
                if ($dataStudent->graduation->status !== 1) {
                    return response()->json(
                        [
                            'status' => 'success',
                            'message' => 'Data nilai belum lengkap',
                            // 'graduationMessage' =>
                            //     'Selamat ' .
                            //     $dataStudent->user->name .
                            //     ', anda lulus!',
                            'data' => $dataStudent,
                        ],
                        200
                    );
                } else {
                    // data nilai lengkap
                    return response()->json(
                        [
                            'status' => 'success',
                            'message' =>
                            'Selamat ' .
                                $dataStudent->user->name .
                                ', anda lulus!',
                            // 'graduationMessage' =>
                            //     'Selamat ' .
                            //     $dataStudent->user->name .
                            //     ', anda lulus!',
                            'data' => $dataStudent,
                        ],
                        200
                    );
                }
            } else {
                // data kelulusan belum dipublikasi
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Pengumuman kelulusan belum dipublikasi',
                        'publish_date' =>
                        $dataStudent->graduation->activity->announcement[0]
                            ->publish_date,
                    ],
                    200
                );
            }
        } else {
            // data kelulusan tidak ditemukan
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Data kelulusan tidak ditemukan',
                ],
                500
            );
        }
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
