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
    public function listRoles()
    {
    	$model = Role::where('name','!=','admin')->get();
    	$routeCollection = Route::getRoutes();
	    $routes = [];
	    foreach ($routeCollection as $key => $value) {
	    	// dump($value->action["as"]);
	    	if($value->action['middleware'][2] == 'role'){
				array_push($routes,$value->action["as"]);
			}
	    }
        // $new_array = [];
        // foreach ($routes as $value){
        //     $new_array[str_replace('.','_',$value)] = true;
        // }
        
    	return ['roles'=>$model,'routes'=>$routes];
    }
    public function updatePermission(Request $request,$id)
    {	
    	$model = Role::find($id);
    	$model->fill($request->except(['token']));
		$model->save();
		return response()->json(['status'=>true,'message'=>'Permissions updated','data'=>$model]);
    }
}