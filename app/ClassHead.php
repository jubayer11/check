<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassHead extends Model
{
    protected $guarded=[];
    public function Lms_class(){
        return $this->hasMany( Lmsclass::class,'classhead_id','id');
    }
    public function classHead(){
        return $this->belongsToMany(ClassHead::class,'user_class_heads','user_id','classHead_id');
    }
    public function classRoutine()
    {
        return $this->hasMany( ClassRoutine::class,'classhead_id','id');

    }

}
