<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;

class UsersController extends Controller
{
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }
   
    public function register(Request $request){
        $user = $this->user->create([
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'password' => bcrypt($request->get('password'))
        ]);
        return response()->json(['status'=>true,'message'=>'User created successfully','data'=>$user]);
    }
    
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }
    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }

    public function listUsers()
    {
    	$model = User::all();
    	return $model;
    }

    public function addUser(Request $request)
    {
    	$model = new User;
    	$model->password = bcrypt($request->get('password'));
        $model->fill($request->except(['token','password']));
        $model->save();
        return response()->json(['status'=>true,'message'=>'User created successfully','data'=>$model]);
    }

    public function editUser($id)
    {
    	$model = User::find($id);
    	return $model;
    }

    public function updateUser(Request $request,$id)
    {	
		$model = User::find($id);
		$model->fill($request->except(['token']));
		$model->save();
		return response()->json(['status'=>true,'message'=>'User updated successfully','data'=>$model]);
    }

    public function deleteUser($id)
    {
    	$model = User::find($id);
        $model->delete();
        return response()->json(['status'=>true,'message'=>'User deleted successfully','data'=>$model]);
    }
}
