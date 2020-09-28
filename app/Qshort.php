<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qshort extends Model
{
    //
    protected $guarded=[];

    public function question(){
        return $this->belongsTo(Question::class,'id','question_id');
    }

    public function Ashort(){
        return $this->hasMany(Ashort::class,'qshort_id','id');
    }

}
