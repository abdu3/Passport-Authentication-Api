<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegiserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
       public function login(Request $request){

        try {
            if(Auth::attempt($request->only('email','password'))){
                $user=Auth::user();
                $token = $user->createToken('app')->accessToken;

                return response([
                    'message'=>'Successfully Login',
                    'token'=>$token,
                    'user'=>$user
                ],200);//states Code
            }

        } catch (Exception $exception) {
            return response([
                'message'=>$exception->getMessage()
            ],400);
        }

        return response([
            'message'=>'invalid Email Or Password'
        ],401);

    } // end Method


    public function Register(RegiserRequest $request){
    	try{

    		$user = User::create([
    			'name' => $request->name,
    			'email' => $request->email,
    			'password' => Hash::make($request->password)
    		]);
    		$token = $user->createToken('app')->accessToken;

    		return response([
    			'message' => "Registration Successfull",
    			'token' => $token,
    			'user' => $user
    		],200);

	    	}catch(Exception $exception){
	    		return response([
	    			'message' => $exception->getMessage()
	    		],400);
	    	}




    } // end mehtod
}
