<?php

namespace App\Http\Controllers;

use App\ClassHead;
use App\ClassRoutine;
use App\Http\Requests\ClassRoutineRequest;
use App\Http\Resources\ClassRoutineResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class classRoutineController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('JWT');
        $this->middleware('role:Admin')->only('CreateEvent','DeleteEvent');


    }
    public function CreateEvent(ClassRoutineRequest $request,$id)
    {

        $rou=ClassRoutine::latest()->first();
        if ($rou!=null)
        {
            $count=$rou->id;
        }
        else
            {
                $count=1;

            }

        if($request->start_number>$request->end_number)
        {
            $this->CreateEvent1($request,$id,$count);
            $this->CreateEvent2($request,$id,$count);
        }
        else
        $routine=new ClassRoutine();
        $routine->name=$request->name;
        $routine->classhead_id=$id;
        $routine->details=$request->details;
        $routine->color=$request->color;
        $routine->type=$request->type;
        $routine->deleteId=$count;
        $routine->start_date=$request->start_date;
        $routine->start_time=$request->start_time;
        $routine->end_date=$request->end_date;
        $routine->end_time=$request->end_time;
        $routine->save();

    }
    public function CreateEvent1($request,$id,$count)
    {

        $routine=new ClassRoutine;
        $routine->name=$request->name;
        $routine->classhead_id=$id;
        $routine->details=$request->details;
        $routine->color=$request->color;
        $routine->type=$request->type;
        $routine->deleteId=$count;
        $routine->start_date=$request->start_date;
        $routine->start_time=$request->start_time;
        $routine->end_date="2019-12-7";
        $routine->end_time="23:59";
        $routine->save();


    }
    public function CreateEvent2($request,$id,$count)
    {
        $routine=new \App\ClassRoutine;
        $routine->name=$request->name;
        $routine->classhead_id=$id;
        $routine->details=$request->details;
        $routine->color=$request->color;
        $routine->deleteId=$count;
        $routine->type=$request->type;
        $routine->start_date="2019-11-30";
        $routine->start_time=$request->start_time;
        $routine->end_date=$request->end_date;
        $routine->end_time=$request->end_time;
        $routine->save();

    }

    public function getEvent($id)
    {
        $classHead=ClassHead::find($id);
        $event=$classHead->classRoutine;

        return ClassRoutineResource::collection($event);
    }
    public function DeleteEvent($id)
    {
        $events = DB::table('class_routines')->where('deleteId', '=', $id)->delete();

    }



}
