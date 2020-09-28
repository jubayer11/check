<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amultiple extends Model
{
    //
    protected $guarded=[];
    public function qmultiple(){
        return $this->belongsTo(Qmultiple::class,'id','qmultiple_id');
    }
    public function Question(){
        return $this->belongsTo(Question::class,'id','question_id');
    }


}
