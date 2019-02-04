<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Redirect; 
use Validator;
class usersController extends Controller
{
    public function index() 
    {
    	return response()->json(User::get());
    }

    public function store(Request $req)
    {
		$validator = Validator::make($req->all(), [ 
            'name' => 'required', 
            'password' => 'required', 
            'email' => 'required|email',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $req->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create(['name' => $input['name'],'email'=> $input['email'],'password' => $input['password'],'count' => 0,'type' => 0]);
        return response()->json('ok',200);
    }

    public function login(Request $req)
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::User(); 
            return Redirect('/');
        } 
        else{ 
            return Redirect::back()->withErrors(['login' => 'Email password Errors']);
        }
    }

    public function logout()
    {
        Auth::logout();

        return Redirect('/login');
    }

    public function getAuth()
    {
        $user = Auth::User();
        return response()->json(Auth::User());
    }
}
