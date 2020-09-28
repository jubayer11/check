<?php

namespace App\Http\Controllers;

use App\ClassHead;
use App\Http\Requests\ClassHeadRequest;
use App\Http\Resources\classHeadResorce;
use Illuminate\Http\Request;

class ClassHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('JWT');
        $this->middleware('role:Admin')->only('index','show','store',' update','destroy');

    }
    public function index()
    {
        //

        $class_Head=ClassHead::latest()->get();
       return classHeadResorce::collection($class_Head);

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
    public function store(ClassHeadRequest $request)
    {
        //
        $classHead=new  ClassHead();
        $classHead->name=$request->name;
        $classHead->status=$request->status;
        $classHead->save();
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
    public function update(ClassHeadRequest $request, $id)
    {
        //
        $EChead=ClassHead::find($id);
        $EChead->name=$request->name;
        $EChead->status=$request->status;
        $EChead->update();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $DChead=ClassHead::find($id);
        $DChead->Lms_class()->delete();
        $DChead->delete();
    }
}
