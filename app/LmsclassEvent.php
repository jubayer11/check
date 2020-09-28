<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LmsclassEvent extends Model
{
    //
    public function lmsclass(){
        return $this->belongsTo(Lmsclass::class,'lmsclass_id','id');
    }
}
