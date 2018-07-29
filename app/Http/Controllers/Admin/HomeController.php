<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index(Request $time_specify){
        if(!$time_specify->only('time')){
            $time_specify->time = 0;
        }
        $time_topUser = $time_specify->time;
        $user = Auth::user();
        $time = Article::getTimePublic();
        foreach ($time as $month){
            $month['view'] = Article::getViewsOfMonth($month->value);
            $month['sum-articles'] = Article::getSumOfArticlesOfMonth($month->value);
        }
        if(count($time)){
            $topUsers = User::getTopUsers($time[$time_topUser]->value);
        }
        else{
            $topUsers = [];
        }
        return view('admin/home', compact(['user', 'time', 'topUsers', 'time_topUser']));
    }

    public function logout(){
        Auth::logout();
        return redirect('/admin/');
    }
}
