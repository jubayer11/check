<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllEvent extends Model
{
    //
    public function getPathAttribute()

    {
        return "/lms/calender";
    }
}
