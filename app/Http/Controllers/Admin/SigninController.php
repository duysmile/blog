<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUser;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class SigninController extends Controller
{
    public function index(){
        return view('admin/signin');
    }

    public function login(LoginUser $request){
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request['email'])->first();
//        $credentials['status'] = $user->status;
        try{
            if(! $token = Auth::attempt($credentials)){
                return redirect("/admin")->with(['error' => 'Email or password is incorrect.']);
            }
        }
        catch(AuthenticationException $exception){
            return redirect("/admin")->with(['error' => 'Fail to login. Please try again.']);

        }
        if($user->status == false){
            return redirect("/admin")->with(['error' => 'Your account is blocked. Please contact admin to solve this problem.']);
        }
//        return response()->json([
//            'success' => true, 'data'=> [ 'token' => $token ]
//        ]);
//        return response()->json(compact('token'));
        return redirect('/admin/home');
    }
}