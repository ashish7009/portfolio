<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UsersController extends Controller
{
    use AuthenticatesUsers;
    private $user;
    protected $maxAttempts = 3;
    protected $decayMinutes = 1;
    public function __construct(User $user){
        $this->user = $user;
    }
   
    public function register(Request $request){

        $user = $this->user->create([
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'password' => bcrypt($request->get('password')),
          'permission' => $request->get('permission')
        ]);
       
        return response()->json(['status'=>true,'message'=>'User created successfully','data'=>$user]);
    }
    
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return response()->json(['Too many logins'], 400);
        }
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            $this->incrementLoginAttempts($request);
            return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        $role = $this->getAuthUserRole($token);
        return response()->json(['token'=>$token,'role'=>$role]);
    }
    public function getAuthUser(Request $request){
        
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }
    public function getAuthUserRole($token){
        $user = JWTAuth::toUser($token);
        
        if ($user->permission == 1) {
            $role = 'admin';
        }
        if ($user->permission == 2) {
            $role = 'account_manager';
        }
        if ($user->permission == 3) {
            $role = 'bdm';   
        }
        return $role;
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
