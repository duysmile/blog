<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index(){
        $user = Auth::user();
        return view('admin/home', compact('user'));
    }
    public function logout(){
        Auth::logout();
        return redirect('/admin/');
    }
}
