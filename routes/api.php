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
Route::post('auth/login', 	['as'=>'login',	'uses'=>'UsersController@login']);
Route::group(['middleware' => 	['jwt.auth', 'role']], function () {
    Route::get('user', 		['as'=>'current.user',    'uses'=>'UsersController@getAuthUser']);

    Route::get('users',				['as'=>'list.user','uses'=>'UsersController@listUsers']);
    Route::post('user/add',			['as'=>'add.user','uses'=>'UsersController@addUser']);
    Route::get('user/edit/{id}',	['as'=>'edit.user','uses'=>'UsersController@editUser']);
    Route::post('user/update/{id}',	['as'=>'update.user','uses'=>'UsersController@updateUser']);
    Route::get('user/delete/{id}',	['as'=>'delete.user','uses'=>'UsersController@deleteUser']);

    Route::get('portfolios',		['as'=>'list.portfolio','uses'=>'PortfolioController@listPortfolio']);
    Route::post('portfolio/add',	['as'=>'add.portfolio','uses'=>'PortfolioController@addPortfolio']);
    Route::get('portfolio/edit/{id}',	['as'=>'edit.portfolio','uses'=>'PortfolioController@editPortfolio']);
    Route::post('portfolio/update/{id}',	['as'=>'update.portfolio','uses'=>'PortfolioController@updatePortfolio']);
    Route::get('portfolio/delete/{id}',	['as'=>'delete.portfolio','uses'=>'PortfolioController@deletePortfolio']);

    Route::get('roles',             ['as'=>'list.roles','uses'=>'RoleController@listRoles']);
    Route::post('permission/update/{id}',['as'=>'update.permission','uses'=>'RoleController@updatePermission']);
});
