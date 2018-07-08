<?php

namespace App\Http\Controllers\User;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListArticleController extends Controller
{
    public function index($category)
    {
        $recentArticles = Article::getRecentArticles();
        $popularArticles = Article::getPopularArticles();
        $categories = Category::getCategory();
        $articles = Article::getArticleByCategory($category);
        $time_public = Article::getTimePublic();

        return view('user.list_article', [
            'category' => $category,
            'recentArticles' => $recentArticles,
            'popularArticles' => $popularArticles,
            'articles' => $articles,
            'categories' => $categories,
            'time_public' => $time_public,
        ]);
    }
    public function search(Request $query){
        $category = "Search";
        $recentArticles = Article::getRecentArticles();
        $popularArticles = Article::getPopularArticles();
        $categories = Category::getCategory();
        $articles = Article::searchFullTextUser($query);
        $time_public = Article::getTimePublic();

        return view('user.list_article', [
            'category' => $category,
            'recentArticles' => $recentArticles,
            'popularArticles' => $popularArticles,
            'articles' => $articles,
            'categories' => $categories,
            'time_public' => $time_public,
        ]);
    }

    public function getByTime(Request $time){
        $category = "Blog Archie";
        $recentArticles = Article::getRecentArticles();
        $popularArticles = Article::getPopularArticles();
        $categories = Category::getCategory();
        $time_public = Article::getTimePublic();

        $articles = Article::getArticleByTime($time->time);
        return view('user.list_article', [
            'category' => $category,
            'recentArticles' => $recentArticles,
            'popularArticles' => $popularArticles,
            'articles' => $articles,
            'categories' => $categories,
            'time_public' => $time_public,
        ]);
    }
}
