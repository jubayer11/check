<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lmsclass extends Model
{
    //
    protected $fillable=['name','section','description','user_id','class_code'];
    public function getPathAttribute()

    {
        return "/lms/class/$this->name";
    }
    public function getRouteKeyName()
    {
        return 'name';
    }
    public  function user(){
       return  $this->belongsTo(User::class);
    }
    public function material(){
        return $this->hasMany(Material::class,'lmsclass_id','id')->latest();
    }

    public function users(){
        return $this->belongsToMany(User::class,'lms_class_users');

    }
    public function announcement(){
        return $this->hasMany(Announcement::class)->latest();

    }
    public function Assignments(){
        return $this->hasMany(Assaignment::class,'lmsclass_id','id')->latest();

    }

    public function exam(){
        return $this->hasMany(Exam::class,'class_id','id');
    }
    public function head(){
        return $this->belongsTo(ClassHead::class,'classhead_id','id');
    }
    public function event()
    {
        return $this->hasMany(LmsclassEvent::class,'lmsclass_id','id');
    }

}
