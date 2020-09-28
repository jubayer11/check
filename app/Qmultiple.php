<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qmultiple extends Model
{
    //
    protected $guarded=[];
    public function question(){
        return $this->belongsTo(Question::class,'id','question_id');
    }
    public function Amultiple(){
        return $this->hasMany(Amultiple::class,'qmultiple_id','id');
    }

}
