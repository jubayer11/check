<?php

namespace App\Http\Controllers;

use App\ClassHead;
use App\Http\Requests\ProfileUpadtaeRequest;
use App\Http\Resources\studentResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\teacherResource;
use App\Http\Resources\UserResource;
use App\Lmsclass;
use App\Notifications\newStudentAssignNotification;
use App\Notifications\newTeacherAssignNotification;
use App\Notifications\newUserAcceptNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class ApiUserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('JWT');
        $this->middleware('role:Admin')->only('assign_allStudent','remove_student','request_user','accept_user','delete_user','student_user','teacher_user','admin_user','assign_student','assign_teacher');


    }
    public function index($id){
        $user=User::find($id);
        return new UserResource($user);

    }

    public function update(Request $request, $id){
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>['required',
                Rule::unique('users','email')->ignore($id, 'id')
                ],

        ]);

        if ($request->checking ==1){
            $exploded=explode(',',$request->image);
            $decoded=base64_decode($exploded[1]);
            if (str_contains($exploded[0],'jpeg'))
                $extension='jpg';
            else
                $extension='png';
            $fileName=str_random().'.'.$extension;
            $path=public_path().'/uploads/x/x/profile/'.$fileName;
            file_put_contents($path,$decoded);

            $user=User::find($id);
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->father_name=$request->father_name;
            $user->mother_name=$request->mother_name;
            $user->phone=$request->email;
            $user->parents_contact=$request->parents_contact;
            $user->email=$request->phone;
            $user->nid=$request->nid;
            $user->image=$fileName;
            $user->address=$request->address;
            $user->status=$request->Status;
            if($request->role)
            {    $roles = $user->getRoleNames();
                if ($roles !=$request->role)
                {
                    $user->classHead()->detach();
                    $user->lmsclass()->detach();
                    $user->syncRoles($request->role);
                }

            }
            $user->update();
            return response('Update',Response::HTTP_ACCEPTED);
            //$id->update($request->except('image')+'image'=>$fileName]);
        } else
            $user=User::find($id);
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->father_name=$request->father_name;
        $user->mother_name=$request->mother_name;
        $user->phone=$request->email;
        $user->parents_contact=$request->parents_contact;
        $user->email=$request->phone;
        $user->nid=$request->nid;
        $user->address=$request->address;
        $user->status=$request->Status;
        if($request->role)
        {
            $roles = $user->getRoleNames();
            foreach ($roles as $role) {
                if ($role != $request->role) {

                    $user->classHead()->detach();
                    $user->lmsclass()->detach();
                    $user->syncRoles($request->role);
                }
            }



        }
        $user->update();
        return response('Update',Response::HTTP_ACCEPTED);
        //$id->update($request->except('image')+['image'=>$fileName]);

    }
    public function CreateStudent(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'bail|required|unique:users,email',
            'email'=>'bail|unique:users,phone,NULL,NULL,phone,0',
            'password'=>'bail|required|confirmed',
            'password_confirmation'=>'required',
            'Status'=>'required',
        ]);
        $user=new User();
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->phone=$request->email;
        $user->password=$request->password;
        $user->email=$request->phone;
        $user->status=$request->Status;
        $user->save();
        $user->assignRole('Student');
    }
    public function CreateAdmin(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'bail|required|unique:users,email',
            'email'=>'bail|unique:users,phone,NULL,NULL,phone,0',
            'password'=>'bail|required|confirmed',
            'password_confirmation'=>'required',
            'Status'=>'required',
        ]);
        $user=new User();
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->phone=$request->email;
        $user->password=$request->password;
        $user->email=$request->phone;
        $user->status=$request->Status;
        $user->save();
        $user->assignRole('Admin');
    }
    public function CreateTeacher(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'bail|required|unique:users,email',
            'email'=>'bail|unique:users,phone,NULL,NULL,phone,0',
            'password'=>'bail|required|confirmed',
            'password_confirmation'=>'required',
            'Status'=>'required',
        ]);
        $user=new User();
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->phone=$request->email;
        $user->password=$request->password;
        $user->email=$request->phone;
        $user->status=$request->Status;
        $user->save();
        $user->assignRole('Teacher');
    }

    public function request_user(){
        $users=User::where('status','=',0)->get();
        return UserResource::collection($users);
    }

    public function accept_user($id){
        $user=User::find($id);
        $user->status=1;
        $user->update();
        $user->notify(new newUserAcceptNotification);
    }

    public function delete_user($id){
        $user=User::find($id);
        $user->delete();
    }

    public function student_user(){

        $users = User::role('Student')->whereIn('status', [1, 2])->latest()->get();
        return studentResource::collection($users);
    }

    public function teacher_user(){

        $users = User::role('Teacher')->whereIn('status', [1, 2])->latest()->get();
        return teacherResource::collection($users);
    }

    public function admin_user(){

        $users = User::role('Admin')->whereIn('status', [1, 2])->latest()->get();
        return UserResource::collection($users);
    }

    public function assign_student(Request $request, $id)
    {



        if ($request->classHead == null) {
            $user = User::find($id);
            $user->classHead()->detach();
            $user->lmsclass()->detach();
        }
        if ($request->classHead != null){
            $request->validate([
                'subject' => 'required',
            ]);
        $user = User::find($id);
        $user->classHead()->detach();
        $user->lmsclass()->detach();
        $user->classHead()->attach($request->classHead);
        $user->lmsclass()->attach($request->subject);
        foreach ($request->subject as $subjects) {
            $classHead = ClassHead::find($request->classHead);
            $subject = Lmsclass::find($subjects);
            $user->notify(new newStudentAssignNotification($classHead, $subject));

        }
    }
    }

    public function assign_teacher(Request $request, $id){

        $user = User::find($id);
        $user->classHead()->detach();
        $user->lmsclass()->detach();
        if ($request->Selected_ClassHaed == null) {

            $user = User::find($id);
            $user->classHead()->detach();
            $user->lmsclass()->detach();
        }
        if ($request->Selected_ClassHaed != '') {
            $request->validate([
                'subject' => 'required',
            ]);
            $user=User::find($id);
            $user->lmsclass()->detach();

            foreach ($request->subject as $subject){
                $subjects=Lmsclass::find($subject['id']);
               foreach($subjects->users as $usert)
               {
                   if ($usert->getRoleNames()->first()=='Teacher'){

                       $subjects->users()->detach($usert->id);
                   }
               }
                foreach ($request->Selected_ClassHaed as $clasHeadIdm) {
                    $ClassHeadIds=ClassHead::find($clasHeadIdm['id']);
                    foreach ($ClassHeadIds->Lms_class as $selectedSubject) {
                          if ($selectedSubject->id==$subject['id']) {

                              $user->lmsclass()->attach($subject['id']);
                              $user->notify(new newTeacherAssignNotification($subjects));
                          }
                    }
                }
            }
            $user->classHead()->detach();
            foreach ($request->Selected_ClassHaed as $clasHeadId) {

                $user->classHead()->attach($clasHeadId['id']);



            }
        }



    }

    public function authenticateUserClassSubject($id){
        $user=User::find($id);
        return SubjectResource::collection($user->lmsclass);
    }

    public function remove_student($user_id, $class_id){
        $user=User::find($user_id);
        $user->lmsclass()->detach($class_id);
    }
    public function assign_allStudent(Request $request)
    {
       foreach($request->students as $student){
           $user=User::find($student);
           $user->classHead()->detach();
           $user->lmsclass()->detach();
           $user->classHead()->attach($request->subject);
       }
    }


}
