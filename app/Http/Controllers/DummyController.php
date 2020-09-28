<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DummyController extends Controller
{
    //
    public function dummy(){
        $role = Role::create(['name' => 'Student']);
    }
}
