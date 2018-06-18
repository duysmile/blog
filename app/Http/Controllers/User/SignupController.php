<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Mail\VerifyMail;
use App\User;
use App\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SignupController extends Controller
{
    public function index(){
        return view('user/signup');
    }

    public function store(StoreUser $request){
        User::saveUser($request);
        return redirect('/')->with('success', 'Please verify your email to finish register!');
    }

    public function verifyUser($token){
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser)){
            $user = $verifyUser->user;
            if(!$user->verify){
                $verifyUser->user->verify = true;
                $verifyUser->user->save();
                $status = "Your email is verified. You can now login.";
            }
            else{
                $status = "Your email is already verified. You can now login.";
            }
        }
        else{
            return redirect('/')->with('success', 'Sorry your email cannot be identified.');
        }
        return redirect('/')->with('success', $status);
    }
}
