<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Http\Requests\RestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RestController extends Controller
{
    public function restPassword(RestRequest $request)
    {
        $email=$request->email;
        $token=$request->token;
        $password=Hash::make($request->password);

        $emailCheck=DB::table('password_resets')->where('email',$email)->first();
        $tokenCheck=DB::table('password_resets')->where('token',$token)->first();

        if(!$emailCheck){
            return response([
                'message'=>"email not Found"
            ],401);
        }
        if(!$tokenCheck){
            return response([
                'message'=>"Pin Code Invalid"
            ],401);
        }

        DB::table('users')->where('email',$email)->update(['password'=>$password]);
        DB::table('password_resets')->where('email',$email)->delete();

        return response([
            "message"=>"password update successfully"
        ],200);

    }
}
