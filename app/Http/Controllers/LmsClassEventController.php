<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassEventCreateRequest;
use App\Http\Requests\ClassEventEditRequest;
use App\Http\Resources\LmsClassEventResource;
use App\Lmsclass;
use App\LmsclassEvent;
use App\Notifications\newSubjectEventNotification;
use App\User;
use Illuminate\Http\Request;

class LmsClassEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('JWT');
        $this->middleware('role:Admin|Teacher')->only('store',' update','destroy');

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
    public function store(ClassEventCreateRequest $request)
    {
        //

        $event=new LmsclassEvent();
        $event->name=$request->name;
        $event->lmsclass_id=$request->subject_id;
        $event->details=$request->details;
        $event->start=$request->start;
        $event->end=$request->end;
        $event->color=$request->color;
        $event->save();
        $users=Lmsclass::find($request->subject_id)->users;
        foreach($users as $user) {
            if ($user->id !== $request->userId) {
                $user->notify(new newSubjectEventNotification($event));
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

        $classEvent=Lmsclass::find($id)->event;
        return LmsClassEventResource::collection($classEvent);
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
    public function update(ClassEventEditRequest $request, $id)
    {
        //

        $event=LmsclassEvent::find($id);
        $event->name=$request->name;
        $event->lmsclass_id=$request->lmsclass_id;
        $event->details=$request->details;
        if ($request->start !='null null'){
            $event->start=$request->start;
        }
        if ($request->end !='null null'){
            $event->end=$request->end;

        }

        $event->color=$request->color;
        $event->update();
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

        $event=LmsclassEvent::find($id);
        $event->delete();
    }
}
