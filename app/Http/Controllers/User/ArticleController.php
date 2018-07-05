<?php

namespace App\Http\Controllers\User;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index($category, $article)
    {
        $recentArticles = Article::getRecentArticles();
        $popularArticles = Article::getPopularArticles();
        $categories = Category::getCategory();

//        $index = strpos($article, "-");
//        $id_article = substr($article, $index, strlen($article) - $index);
        $article_content = Article::getArticleContent($article);
        $category_content = Article::getArticleLike($category, $article_content);

        $time_public = Article::getTimePublic();

        return view('user.content_article', [
            'recentArticles' => $recentArticles,
            'popularArticles' => $popularArticles,
            'article' => $article_content,
            'categories' => $categories,
            'articles_like' => $category_content,
            'time_public' => $time_public,
        ]);
    }
}
