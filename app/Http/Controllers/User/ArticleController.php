<?php

namespace App\Http\Controllers\User;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index($article)
    {
        $recentArticles = Article::getRecentArticles();
        $popularArticles = Article::getPopularArticles();
        $topArticles = Article::getTopArticles();
        $categories = Category::getCategory();

        $index = strpos($article, "-");
        $id_article = substr($article, $index, strlen($article) - $index);
        $article_content = Article::where([
            'id' => $id_article,
            'id_status' => 2,
        ])->first();

        return view('user.content_article', [
            'recentArticles' => $recentArticles,
            'popularArticles' => $popularArticles,
            'topArticles' => $topArticles,
            'categories' => $categories,
        ]);
    }
}
