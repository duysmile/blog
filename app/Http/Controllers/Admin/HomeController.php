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
    public function index(){
        $user = Auth::user();
        $time = Article::getTimePublic();
        foreach ($time as $month){
            $month['view'] = Article::getViewsOfMonth($month->value);
            $month['sum-articles'] = Article::getSumOfArticlesOfMonth($month->value);
        }
        $topUsers = User::getTopUsers($time[0]->value);
        return view('admin/home', compact(['user', 'time', 'topUsers']));
    }
    public function logout(){
        Auth::logout();
        return redirect('/admin/');
    }
}
