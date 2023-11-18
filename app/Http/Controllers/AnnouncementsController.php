<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Http\Requests\StoreAnnouncementsRequest;
use App\Http\Requests\UpdateAnnouncementsRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AnnouncementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcements::select(["title", "content", "created_at", "id"])
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();

        // Iterar sobre cada anuncio y formatear la fecha
        foreach ($announcements as &$announcement) {
            $announcement["created_at"] = Carbon::parse($announcement["created_at"])->format('F jS, Y');

            $announcement["content"] =  explode("\n", $announcement["content"]);
        }

        return view("client.announcements")->with(["data" => $announcements]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (Auth::user()['role'] != 'admin') {
            return redirect('/dashboard');
        }
        
        $reponse = [];
        try {
            $new_announcement = Announcements::create($request->except("_token"));
            $new_announcement->save();
            $reponse = [
                "type" => "success",
                "message" => "Announcement published."
            ];
        } catch (Exception $e) {
            $reponse = [
                "type" => "error",
                "message" => "Failed to publish the advertisement."
            ];
        }
        return back()->with(["response" => $reponse]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnouncementsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcements $announcements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcements $announcements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnouncementsRequest $request, Announcements $announcements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return response('ok', 401);
        }
        if (Auth::user()['role'] != 'admin') {
            return response('ok', 401);
        }
        try {
            Announcements::where('id', $id)->delete();
        } catch (Exception $e) {
            return response(':(', 500);
        }
        return response('Ok', 200);
    }
}
