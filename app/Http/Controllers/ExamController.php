<?php

namespace App\Http\Controllers;

use App\Acreative;
use App\Amultiple;
use App\Ashort;
use App\Exam;
use App\Exam_user;
use App\Http\Resources\QuestionResource;
use App\Lmsclass;
use App\Notifications\newExamStartNotification;
use App\Question;
use Illuminate\Http\Request;
use Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('JWT');
        $this->middleware('role:Admin|Teacher')->only('QuestionCreate','StartExam','StartExam','StopExam','EndExam','Marks_update','show');
        $this->middleware('role:Admin|Student')->only('AnswerCreate','updating_Examuser','user_examDone','show');

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
    public function store(Request $request)
    {


    }



    public function QuestionCreate(Request $request,$id)
    {

        $class = Lmsclass::find($id);
        $class->exam()->createMany([
            [
                'teacher_id' => $request->form['user_id'],
                'type' => $request->form['date'],
                'status' => 0,
                'exam_done'=>0,
            ],
        ]);

        if ($request->form['qcc'] == 1) {
            $exam = Exam::latest()->first();
            $x=$exam->Question()->create([
                'type' => 'Creative',
            ]);


            foreach ($request->creatives as $creative) {
                $question = Question::find($x->id);
                $question->Qcreative()->create([

                    'story' => $creative['story'],
                    'question_1' => $creative['q1'],
                    'question_2' => $creative['q2'],
                    'question_3' => $creative['q3'],
                    'question_4' => $creative['q4'],
                    'q1_marks' => $creative['q1m'],
                    'q2_marks' => $creative['q2m'],
                    'q3_marks' => $creative['q3m'],
                    'q4_marks' => $creative['q4m'],
                    'all_marks' => $creative['q1m'] + $creative['q2m'] + $creative['q3m'] + $creative['q4m']

                ]);

            }
        };

        if ($request->form['qcm'] == 1) {

            $exam = Exam::latest()->first();
            $y=$exam->Question()->create([
                'type' => 'Multiple',
            ]);
            $questiont=Question::find($y->id);
            foreach ($request->multiples as $multiple) {
                $questiont->Qmultiple()->create([

                    'question' => $multiple['qm'],
                    'option_1' => $multiple['op1'],
                    'option_2' => $multiple['op2'],
                    'option_3' => $multiple['op3'],
                    'option_4' => $multiple['op4'],
                    'marks' => $multiple['qmm'],


                ]);

            }

        };
        if ($request->form['qcp'] == 1) {

            $exam = Exam::latest()->first();
            $z=$exam->Question()->create([
                'type' => 'Pool',
            ]);


            $questionsa=Question::find($z->id);
            foreach ($request->pools as $pool) {
                $questionsa->Qpoll()->create([
                    'question' => $pool['qp'],
                    'option_1' => $pool['op1'],
                    'option_2' => $pool['op2'],
                    'option_3' => $pool['op3'],
                    'option_4' => $pool['op4'],

                ]);

            }
        };
        if ($request->form['qcs'] == 1) {

            $exam = Exam::latest()->first();
            $n=$exam->Question()->create([
                'type' => 'Short',
            ]);

            $questionsss=Question::find($n->id);
            foreach ($request->shorts as $short) {
                $questionsss->Qshort()->create([
                    'question' => $short['qs'],
                    'marks' => $short['qsm'],


                ]);

            }

        }

    }

    public function AnswerCreate(Request $request,$id){

        if($request->form['qcreative_id']!=null) {
            $question = Question::find($request->form['qcreative_id']);
            foreach ($request->Acreatives as $acreative) {
                $question->Acreative()->create([

                    'qcreative_id' => $acreative['question_id'],
                    'user_id' => $request->form['user_id'],
                    'aquestion_1' => $acreative['answer1'],
                    'aquestion_2' => $acreative['answer2'],
                    'aquestion_3' => $acreative['answer3'],
                    'aquestion_4' => $acreative['answer4'],

                ]);
            }

        };
        if($request->form['qmultiple_id']!=null) {
            $question = Question::find($request->form['qmultiple_id']);
            foreach ($request->Amultiples as $multiple) {
                $question->Amultiple()->create([
                    'user_id'=>$request->form['user_id'],
                    'qmultiple_id'=>$multiple['question_id'],
                    'answer'=>$multiple['answer'],


                ]);
            }

        };
        if($request->form['qpoll_id']!=null) {
            $question = Question::find($request->form['qpoll_id']);
            foreach ($request->Apools as $poll) {
                $question->Apoll()->create([
                    'user_id'=>$request->form['user_id'],
                    'qpoll_id'=>$poll['question_id'],
                    'answer'=>$poll['answer'],

                ]);
            }

        };
        if($request->form['qshort_id']!=null) {
            $question = Question::find($request->form['qshort_id']);
            foreach ($request->Ashorts as $short) {
                $question->Ashort()->create([
                    'user_id'=>$request->form['user_id'],
                    'qshort_id'=>$short['question_id'],
                    'answer'=>$short['answer'],

                ]);
            }

        };


    }

    public function updating_Examuser(Request $request, $id)
    {


        $users = Exam_user::where([
            ['exam_id', '=', $id],
            ['user_id', '=', $request->user_id],
        ])->get();
        foreach ($users as $user) {
            $user->exam_done = 1;
            $user->update();
        }

    }

    public function StartExam(Request $request, $id){
        $exam=Exam::find($id);
        $exam->end_date=$request->end_date;
        $exam->end_time=$request->end_time;
        $exam->status=$request->status;
        $exam->update();
        $users=Lmsclass::find($request->subject_id)->users;
        $subject=Lmsclass::find($request->subject_id);
        foreach($users as $user) {
            if ($user->id !== $request->userId) {
                $user->notify(new newExamStartNotification ($subject));
            }
        }


    }

    public function StopExam(Request $request, $id)
    {
        $exam = Exam::find($id);
        $exam->end_date = null;
        $exam->end_time = null;
        $exam->status = 0;
        $exam->update();
    }

    public function EndExam(Request $request, $id){
        $exam=Exam::find($id);
        $exam->exam_done = 1;
        $exam->update();

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show($exam)
    {

        $question=Exam::find($exam)->Question;
        return QuestionResource::collection($question);

    }

    public function user_examDone(Request $request, $id)
    {

        if ($request->check == 5) {
            $user_exam = new Exam_user();
            $user_exam->exam_id = $id;
            $user_exam->user_id = $request->user_id;
            $user_exam->exam_done = 0;
            $user_exam->save();
        }


    }

    public function Marks_update(Request $request)
    {


        if ($request->form['acreative_id'] != null) {
            foreach ($request->Mcreatives as $Mcreative) {
                $somes = Acreative::find($Mcreative['question_id']);
                if ($Mcreative['marks1'] != null) {
                    $somes->aq1_marks = $Mcreative['marks1'];
                }
                if ($Mcreative['marks2'] != null) {
                    $somes->aq2_marks = $Mcreative['marks2'];
                }
                if ($Mcreative['marks3'] != null) {
                    $somes->aq3_marks = $Mcreative['marks3'];
                }
                if ($Mcreative['marks4'] != null) {
                    $somes->aq4_marks = $Mcreative['marks4'];
                }
                $somes->update();


            }

        }
        if ($request->form['amultiple_id'] != null) {
            foreach ($request->Mmultiples as $Mmultiple) {
                $somes = Amultiple::find($Mmultiple['question_id']);
                $somes->marks = $Mmultiple['marks'];
                $somes->update();


            }

        }
        if ($request->form['ashort_id'] != null) {
            foreach ($request->Mshorts as $Mshort) {
                $somes = Ashort::find($Mshort['question_id']);
                $somes->marks = $Mshort['marks'];
                $somes->update();


            }

        }
    }


}
