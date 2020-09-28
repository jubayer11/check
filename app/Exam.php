<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $guarded=[];

    public function Question(){
        return $this->hasMany(Question::class,'exam_id','id');
    }
    public function class(){
        return $this->belongsTo(Lmsclass::class,'id','class_id');
    }
    public function users(){
        return $this->belongsToMany(User::class,'exam_users','exam_id','user_id')->withPivot('exam_done','user_id');

    }
}
