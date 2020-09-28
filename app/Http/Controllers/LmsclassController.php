<?php

namespace App\Http\Controllers;

use App\ClassHead;
use App\Http\Requests\SubjectCreateRequest;
use App\Http\Requests\SubjectEditRequest;
use App\Http\Resources\lmsClassHeadResource;
use App\Http\Resources\LmsclassResource;
use App\Http\Resources\LmsuserResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\UserResource;
use App\Lmsclass;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LmsclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function __construct()
//    {
//        $this->middleware('JWT');
//        $this->middleware('role:Admin')->only('index','store','update','destroy');
//    }

    public function index()
    {
        //


        $subject=Lmsclass::all();
        return SubjectResource::collection($subject);

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
    public function store(SubjectCreateRequest $request)
    {
        //


        $class=new Lmsclass();
        $class->name=$request->name;
        $class->section=$request->section;
        $class->user_id=$request->user_id;
        $class->status=$request->status;
        $class->description=$request->description;
        $class->classhead_id=$request->class_head['id'];
        $class->save();

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

        $class=User::find($id)->classHead;
        return lmsClassHeadResource::collection($class);

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
    public function update(SubjectEditRequest $request, $id)
    {
        //

        $subject=Lmsclass::find($id);
        $subject->classhead_id=$request->class_id;
        $subject->name=$request->name;
        $subject->section=$request->section;
        $subject->description=$request->description;
        $subject->status=$request->status;
        $subject->update();


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
        $subject_delete=Lmsclass::find($id);
        $subject_delete->delete();
    }
    public function information(Lmsclass $name)
    {

        return new LmsclassResource($name);

    }
    public function user($id)

    {
        $users=Lmsclass::find($id)->users;
       return userResource::collection($users);

    }
    public function allClass()
    {
        $class=ClassHead::all();
        return $class;
    }
    public function gettingSubject($id)
    {

        $classHead=ClassHead::find($id);
        return $classHead->Lms_class;


    }

}
