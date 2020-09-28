<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qcreative extends Model
{
    //
    protected $guarded=[];
    public function question(){
        return $this->belongsTo(Question::class,'id','question_id');
    }
    public function Acreative(){
        return $this->hasMany(Acreative::class,'qcreative_id','id');
    }



}
