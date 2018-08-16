<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    static public function hasAccess($role)
    {
    	$model = Role::all();
    	dd($model);
    }
}
