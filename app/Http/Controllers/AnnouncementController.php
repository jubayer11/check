<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Http\Requests\AnnouncementCreateRequest;
use App\Http\Requests\AnnouncementEditRequest;
use App\Http\Resources\AnnouncementResource;
use App\Lmsclass;
use App\Notifications\newaAnnouncementNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('JWT');
        $this->middleware('role:Admin|Teacher')->only('store','update','destroy');

    }
    public function index()
    {
        //


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
    public function store(AnnouncementCreateRequest $request)
    {
        //
        $ann=new Announcement();
        $ann->title=$request->title;
        $ann->body=$request->body;
        $ann->user_id=$request->user_id;
        $ann->lmsclass_id=$request->lmsclass_id;
        $ann->save();
        $users=$ann->lmsclass->users;
        foreach($users as $user) {
            if ($user->id !== $request->user_id) {
                $user->notify(new newaAnnouncementNotification($ann));
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

        $ann=Lmsclass::find($id)->announcement;

       return AnnouncementResource::collection($ann);
    }

    /**
     * Show the form for editing the specified resource
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
    public function update(AnnouncementEditRequest $request, $id)
    {
        //
        $ann=Announcement::find($id);
        $ann->title=$request->title;
        $ann->body=$request->body;
        $ann->update();

        return response('Update',Response::HTTP_ACCEPTED);
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
        $ann=Announcement::find($id);
        $ann->delete();
        return response(null,204);

    }
}
