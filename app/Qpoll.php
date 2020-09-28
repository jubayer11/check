<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qpoll extends Model
{
    //
    protected $guarded=[];

    public function question(){
        return $this->belongsTo(Question::class,'id','question_id');
    }
    public function Apoll(){
        return $this->hasMany(Apoll::class,'qpoll_id','id');
    }


}
