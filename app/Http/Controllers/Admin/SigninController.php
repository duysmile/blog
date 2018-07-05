<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUser;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = "/admin/home";

    public function __construct()
    {
        return $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('admin/signin');
    }

    public function login(LoginUser $request){
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request['email'])->first();
//        $credentials['status'] = $user->status;

        try{
            if($user->status == 0){
                return redirect("/admin")->with(['error' => 'Your account is blocked. Please contact admin to solve this problem.']);
            }
            if(! $token = Auth::attempt($credentials)){
                return redirect("/admin")->with(['error' => 'Email or password is incorrect.']);
            }
        }
        catch(AuthenticationException $exception){
            return redirect("/admin")->with(['error' => 'Fail to login. Please try again.']);
        }

        return redirect('/admin/home');
    }
}