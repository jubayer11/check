<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ashort extends Model
{
    //
    protected $guarded=[];
    public function qshort(){
        return $this->belongsTo(Qshort::class,'id','qshort_id');
    }
    public function Question(){
        return $this->belongsTo(Question::class,'id','question_id');
    }
}
