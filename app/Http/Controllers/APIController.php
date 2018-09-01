<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Hash;
use JWTAuth;

class APIController extends Controller
{
	public function register(Request $request)
    {        
    	$input = $request->all();
    	$input['password'] = Hash::make($input['password']);
    	User::create($input);
        return response()->json(['result'=>true]);
    }
    

    // public function login(Request $request)
    // {
    // 	$input = $request->all();
    // 	if (!$token = JWTAuth::attempt($input)) {
    //         return response()->json(['result' => 'wrong email or password.']);
    //     }
    //     return response()->json(['result' => $token]);
    // }

    public function login(Request $request)
    {
        $input = $request->all();
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['status' => 'error', 'msg' => 'wrong email or password.']);
        }
        return response()->json(['status'=> 'success', 'msg' => 'login successfully', 'token' => $token]);
    }


    public function get_user_details(Request $request)
    {
    	$input = $request->all();
    	// $user = JWTAuth::toUser($input['token']);
    	$user = JWTAuth::toUser($request->header('token'));
        return response()->json(['result' => $user]);
    }
}
