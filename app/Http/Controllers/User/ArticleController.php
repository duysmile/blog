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
        $category_content = Category::where([
            'name' => $category,
        ])->first();

        $category_content = Category::getArticleBelong($category_content, $article_content);

        return view('user.content_article', [
            'recentArticles' => $recentArticles,
            'popularArticles' => $popularArticles,
            'article' => $article_content,
            'categories' => $categories,
            'articles_like' => $category_content
        ]);
    }
}
