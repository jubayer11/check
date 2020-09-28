<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Assaignment;
use App\Http\Requests\AssignmentCreateRequest;
use App\Http\Requests\AssignmentEditRequest;
use App\Http\Resources\AssignmentResource;
use App\Lmsclass;
use App\Notifications\newAssignmentNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AssaignmentController extends Controller
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
    public function store(AssignmentCreateRequest $request)
    {

        if ($request->check ==1) {
//        $base64_encoded_string =$request->file;
            $exploded = explode(',', $request->file);
            $decoded = base64_decode($exploded[1]);
            if (str_contains($exploded[0], 'vnd.openxmlformats-officedocument.wordprocessingml.document')) {
                $extension = 'docx';
            } elseif (str_contains($exploded[0], 'vnd.openxmlformats-officedocument.presentationml.presentation')) {
                $extension = 'pptx';
            } elseif (str_contains($exploded[0], 'msword')) {
                $extension = 'doc';
            } elseif (str_contains($exploded[0], 'pdf')) {
                $extension = 'pdf';
            } elseif (str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpeg';
            } elseif (str_contains($exploded[0], 'png')) {
                $extension = 'png';
            } else
                $extension = 'pdf';
            $fileName = str_random() . '.' . $extension;
            $path = public_path() . '/uploads/x/x/assignment/' . $fileName;
            file_put_contents($path, $decoded);
            $assignment = new Assaignment();
            $assignment->user_id = $request->user_id;
            $assignment->lmsclass_id = $request->class_id;
            $assignment->title = $request->title;
            $assignment->deadline = $request->deadline;
            $assignment->body = $request->body;
            $assignment->file = $fileName;
            $assignment->save();
            $users=$assignment->lmsclass->users;
            foreach($users as $user) {
                if ($user->id !== $request->user_id) {
                    $user->notify(new newAssignmentNotification($assignment));
                }
            }
        }
        else
        $assignment = new Assaignment();
        $assignment->user_id = $request->user_id;
        $assignment->lmsclass_id = $request->class_id;
        $assignment->title = $request->title;
        $assignment->deadline = $request->deadline;
        $assignment->body = $request->body;
        $assignment->save();
        $users=$assignment->lmsclass->users;
        foreach($users as $user) {
            if ($user->id !== $request->user_id) {
                $user->notify(new newAssignmentNotification($assignment));
            }
        }
        return response('Created',Response::HTTP_ACCEPTED);
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
        $ann=Lmsclass::find($id)->Assignments;
        return AssignmentResource::collection($ann);

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
    public function update(AssignmentEditRequest $request, $id)
    {
        //

//        $base64_encoded_string =$request->file;
        if ($request->check==1) {
            $exploded = explode(',', $request->file);
            $decoded = base64_decode($exploded[1]);
            if (str_contains($exploded[0], 'docx'))
                $extension = 'docx';
            else
                $extension = 'pdf';
            $fileName = str_random() . '.' . $extension;
            $path = public_path() . '/uploads/x/x/assignment/' . $fileName;
            file_put_contents($path, $decoded);
            $assignment = Assaignment::find($request->id);
            $assignment->title = $request->title;
            $assignment->deadline = $request->deadline;
            $assignment->body = $request->body;
            $assignment->file = $fileName;
            $assignment->save();
        }
        else
        $assignment = Assaignment::find($request->id);
        $assignment->title = $request->title;
        $assignment->deadline = $request->deadline;
        $assignment->body = $request->body;
        $assignment->save();
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
        $assignment=Assaignment::find($id);
        $assignment->delete();
    }




}
