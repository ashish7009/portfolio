<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    $routeCollection = Route::getRoutes();
    $routes = [];
    foreach ($routeCollection as $key => $value) {
    	// dump($value->action["as"]);
    	if($value->action['middleware'][2] == 'role'){
			array_push($routes,$value->action["as"]);
		}
    }
    dd($routes);
});
