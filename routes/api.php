<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('auth/register', 	['as'=>'register',	'uses'=>'UsersController@register']);
Route::post('auth/login', 		'UsersController@login');
Route::group(['middleware' => 	'jwt.auth'], function () {
    Route::get('user', 		'UsersController@getAuthUser');

    Route::get('users',			['as'=>'list.user','uses'=>'UsersController@listUsers']);
    Route::post('user/add',		['as'=>'add.user','uses'=>'UsersController@addUser']);
    Route::get('user/edit/{id}',	['as'=>'edit.user','uses'=>'UsersController@editUser']);
    Route::post('user/update/{id}',	['as'=>'update.user','uses'=>'UsersController@updateUser']);
    Route::get('user/delete/{id}',	['as'=>'delete.user','uses'=>'UsersController@deleteUser']);
});
