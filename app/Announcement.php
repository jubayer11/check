<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //
    protected $guarded=[];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function lmsclass(){
        return $this->belongsTo(Lmsclass::class,'lmsclass_id','id');
    }
}
