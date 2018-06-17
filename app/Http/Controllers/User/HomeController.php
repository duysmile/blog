<?php

namespace App\Http\Controllers\User;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
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
        if(Article::count()){
            $articles = Article::latest()->paginate(3);
            foreach($articles as $key => $article){
                $article['author'] = $article->author->name;
            }
        }
        else {
            $articles = [];
        }
        $categories = Category::all();
        return view('user.home', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}
