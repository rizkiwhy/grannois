<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use App\Models\Activity;
use App\Models\User;

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

        // get all data user
        $data['user'] = User::all();

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
            'content' => 'required',
            'letterNumber' => 'required',
        ]);

        // cari data activity untuk keperluan isi kolom note table announcement
        $activity = Activity::find($request->activityId);

        // set data publisher
        $publisher =
            Auth::user()->role_id === 1
                ? $request->publisher
                : Auth::user()->id;

        // create announcement
        $createAnnouncement = Announcement::create([
            'activity_id' => $request->activityId,
            'publish_date' => $request->publishDate,
            'publisher' => $publisher,
            'note' => $activity->note,
            'content' => $request->content,
            'letter_number' => $request->letterNumber,
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
        $data['layout'] = 'layouts.master';
        $data['page'] = 'Pengumuman';
        $data['subpage'] = 'Edit';
        $data['app'] = 'Graduation Announcement Information System';

        // get announcement yang akan diubah
        $data['announcement'] = Announcement::find($id);

        // get all announcement
        $announcement = Announcement::all();

        // temp array activityId yang sudah digunakan
        $tempArrActivityId = [];

        // mencari & mengisi activityId yang sudah digunakan ke $tempArrActivityId
        for ($i = 0; $i < count($announcement); $i++) {
            array_push($tempArrActivityId, $announcement[$i]->activity_id);
        }

        // dd($tempArrActivityId);

        // get all data activity yang belum dibuat pengumuman
        $data['activity'] = Activity::with([
            'activityType',
            'announcement',
            'graduation',
        ])
            ->whereNotIn('id', $tempArrActivityId)
            ->get();

        // get all data user
        $data['user'] = User::all();

        return view('pages.curriculum.announcement.edit', compact('data'));
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
            'publishDate' => 'required',
            'content' => 'required',
            'letterNumber' => 'required',
        ]);

        // cari data activity untuk keperluan isi kolom note table announcement
        $activity = Activity::find($request->activityId);

        // set data publisher
        $publisher =
            Auth::user()->role_id === 1
                ? $request->publisher
                : Auth::user()->id;

        // cari data announcement duplikat
        $duplicateAnnouncement = Announcement::where(
            'note',
            $activity->note
        )->get();

        // data announcement duplicate
        if ($duplicateAnnouncement->count() > 1) {
            return redirect()
                ->route('announcement.index')
                ->with(
                    'error_message',
                    'Entri duplikat ' . $activity->note . '!'
                );
        } else {
            // update announcement
            $updateAnnouncement = Announcement::find($id)->update([
                'activity_id' => $request->activityId,
                'publish_date' => $request->publishDate,
                'publisher' => $publisher,
                'note' => $activity->note,
                'content' => $request->content,
                'letter_number' => $request->letterNumber,
            ]);
            // update announcement berhasil
            if ($updateAnnouncement) {
                return redirect()
                    ->route('announcement.index')
                    ->with(
                        'success_message',
                        'Pengumuman ' . $activity->note . ' berhasil diubah!'
                    );
            } else {
                return redirect()
                    ->route('announcement.index')
                    ->with(
                        'error_message',
                        'Pengumuman ' . $activity->note . 'gagal diubah!'
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
    public function destroy($id)
    {
        // cari announcement
        $announcement = Announcement::withTrashed()->find($id);

        // delete announcement
        $destroyAnnouncement = $announcement->delete();

        // delete announcement berhasil
        if ($destroyAnnouncement) {
            return redirect()
                ->route('announcement.index')
                ->with(
                    'success_message',
                    'Kegiatan ' . $announcement->note . ' berhasil dihapus!'
                );
        } else {
            return redirect()
                ->route('announcement.index')
                ->with(
                    'error_message',
                    'Kegiatan ' . $announcement->note . 'gagal dihapus!'
                );
        }
    }
}
