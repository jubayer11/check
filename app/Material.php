<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    protected $guarded=[];

    public function lmsclass(){
        return $this->belongsTo(Lmsclass::class,'lmsclass_id','id');
}
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }


}
