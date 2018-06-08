<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $users = User::all();
        return view('home', ['users' => $users]);
    }
    public function create($input){
        $user = new User();
        $user->name = $input->name;
        $user->email = $input->email;
        $user->password = $input->password;
        return $user->save()? "true" : "false";
    }
    public function view($id){
        $users = User::find($id);
        return view('home', ['users' => $users]);
    }
}
