<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiRoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ApiRoleController extends Controller
{
    //

    public function index(){
        $all_roles = Role::where('id', '!=', 1)->get();
        return ApiRoleResource::collection($all_roles);

    }
}
