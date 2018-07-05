<?php

namespace App\Http\Controllers\User;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use DeepCopy\f001\A;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $articles = Article::getPublicArticles();
        $recentArticles = Article::getRecentArticles();
        $popularArticles = Article::getPopularArticles();
        $topArticles = Article::getTopArticles();
        $categories = Category::getCategory();
        $time_public = Article::getTimePublic();
        return view('user.home', [
            'articles' => $articles,
            'recentArticles' => $recentArticles,
            'popularArticles' => $popularArticles,
            'topArticles' => $topArticles,
            'categories' => $categories,
            'time_public' => $time_public,
        ]);
    }
}
