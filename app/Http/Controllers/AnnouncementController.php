<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use App\Models\Activity;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Pengumuman';
        $data['subpage'] = 'Index';
        $data['app'] = 'Graduation Announcement Information System';

        // get all data announcement
        $data['announcement'] = Announcement::with([
            'activity.activityType',
            'user',
        ])->get();

        // temp array activityId yang sudah digunakan
        $tempArrActivityId = [];

        // mencari & mengisi activityId yang sudah digunakan ke $tempArrActivityId
        for ($i = 0; $i < count($data['announcement']); $i++) {
            array_push(
                $tempArrActivityId,
                $data['announcement'][$i]->activity_id
            );
        }

        // get all data activity yang belum dibuat pengumuman
        $data['activity'] = Activity::with([
            'activityType',
            'announcement',
            'graduation',
        ])
            ->whereNotIn('id', $tempArrActivityId)
            ->get();

        return view('pages.curriculum.announcement.index', compact('data'));
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
            'publishDate' => 'required',
        ]);

        // cari data activity untuk keperluan isi kolom note table announcement
        $activity = Activity::find($request->activityId);

        // create announcement
        $createAnnouncement = Announcement::create([
            'activity_id' => $request->activityId,
            'publish_date' => $request->publishDate,
            'publisher' => Auth::user()->id,
            'note' => $activity->note,
        ]);

        // create announcement berhasil
        if ($createAnnouncement) {
            return redirect()
                ->route('announcement.index')
                ->with(
                    'success_message',
                    'Pengumuman ' .
                        ucwords($createAnnouncement->note) .
                        ' berhasil ditambahkan!'
                );
        } else {
            return redirect()
                ->route('announcement.index')
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
