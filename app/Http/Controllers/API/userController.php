<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth; 
class userController extends Controller
{
    public function reg(Request $req) 
    {
    	$validator = Validator::make($req->all(), [ 
            'name' => 'required', 
            'email' => 'required|unique:users', 
            'password' => 'required', 
            'phone' => 'required'
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $req->all(); 

        $input['password'] = bcrypt($input['password']);
        $active_code  = rand(1,6);
         $user =  User::create([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'password' => $input['password'],
            'active_code' => $active_code,
            'email' => $input['email'],
            'count' => 0,
            'type' => 2
        ]);

        $success['token'] =  $user->createToken('smart')-> accessToken; 
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], 200); 
    }

     public function login(Request $req) 
    {
		if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){ 
            $user = Auth::User(); 
            $success['token'] =  $user->createToken('tfran')-> accessToken; 
            $userApp = new User;
            $type= $userApp::where('phone',request('phone'))->value('type');
            return response()->json(['success' => $success,'type' => $type], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }
}
