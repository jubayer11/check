<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $guarded = [];

    public function Exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function Qcreative()
    {
        return $this->hasMany(Qcreative::class, 'question_id', 'id');

    }

    public function Qmultiple()
    {
        return $this->hasMany(Qmultiple::class, 'question_id', 'id');

    }

    public function Qpoll()
    {
        return $this->hasMany(Qpoll::class, 'question_id', 'id');

    }
    public function Qshort(){
        return $this->hasMany(Qshort::class,'question_id','id');
    }
    public function Acreative(){
        return $this->hasMany(Acreative::class,'question_id','id');
    }
    public function Amultiple(){
        return $this->hasMany(Amultiple::class,'question_id','id');
    }
    public function Apoll(){
        return $this->hasMany(Apoll::class,'question_id','id');
    }
    public function Ashort(){
        return $this->hasMany(Ashort::class,'question_id','id');
    }


}
