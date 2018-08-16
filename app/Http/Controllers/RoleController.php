<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{
    static public function hasAccess($role)
    {	
    	$model = Role::where('name',$role)->first();
    	$myArray = explode(',',$model->allowed_routes);
    	if (in_array(Route::getCurrentRoute()->action['as'], $myArray)) {
		    return true;
		}
		return false;
    }
}

