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
        $dataGraduation = Student::where('student_parent_number', $id)
            ->with([
                'graduation.activity.announcement',
                'competencyOfExpertise',
                'user',
            ])
            ->first();

        if (DB::connection()->getPdo()) {
            if ($dataGraduation) {
                $publish_date = Student::where('student_parent_number', $id)
                    ->with(['graduation.activity.announcement'])
                    ->first()->graduation->activity->announcement[0]
                    ->publish_date;
                // dd(date('Y-m-d'));
                if (date('Y-m-d') >= $publish_date) {
                    return response()->json(
                        [
                            'code' => 200,
                            'status' => 'success',
                            'message' => 'Data siswa berhasil ditemukan',
                            'data' => $dataGraduation,
                        ],
                        200
                    );
                } else {
                    return response()->json(
                        [
                            'code' => 200,
                            'status' => 'error',
                            'message' =>
                                'Pengumuman kelulusan belum dipublikasi',
                            'publish_date' => $publish_date,
                        ],
                        200
                    );
                }
            } else {
                return response()->json(
                    [
                        'code' => 500,
                        'status' => 'error',
                        'message' => 'Data kelulusan tidak ditemukan',
                    ],
                    500
                );
            }
        } else {
            return response()->json(
                [
                    'code' => 501,
                    'status' => 'error',
                    'message' => 'Koneksi Gagal !',
                ],
                501
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
