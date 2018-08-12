<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class SocialAuthFacebookController extends Controller
{
    public function redirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback() {

    }
}
