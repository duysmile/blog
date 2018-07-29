<?php

namespace App;

use App\Http\Controllers\FullTextSearch;
use App\Http\Requests\StoreArticle;
use App\Http\Requests\UpdateArticle;
use Carbon\Carbon;
use DateTime;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'content', 'id_author'];
    protected $table = 'articles';

    protected static $num_article_user = [
        'home_top' => 3,
        'home_list' => 6,
        'side_recent' => 3,
        'side_popular' => 3,
        'list_category' => 10,
        'list_search' => 10,
        'list_archie' => 10,
        'list_like' => 3,
    ];

    private static function getSummary($content){
        $summary = preg_replace("/<[^>]*>/","", $content);
        preg_match_all('/\./', $summary,$matches, PREG_OFFSET_CAPTURE);
        if(count($matches[0]) > 1){
            $endpoint = $matches[0][1][0] + 1; //get second dot in paragraph
        }
        else{
            $endpoint = strlen($summary);
        }
        $summary = substr($summary, 0, $endpoint) . "...";
        return $summary;
    }

    public static function getAuthor($articles)
    {
        foreach ($articles as $article){
            $article['author'] = $article->author->name;
            $article['status'] = $article->status->name;
        }
        return $articles;
    }

    public static function getCategories($article)
    {
        $categories = [];
        foreach($article->categories as $category){
            $categories[] = $category->name;
        }
        return $categories;
    }

    public static function getArticles(){
        $articles = Article::latest()->paginate(20);
        $articles = self::getAuthor($articles);
        return $articles;
    }

    public static function getArticlesByAuthor($id_author)
    {
        $articles = User::where('id', $id_author)->first()->articles()->paginate(10);
        $articles = self::getAuthor($articles);
        return $articles;
    }

    public static function getRecentArticles()
    {
        $articles = Article::where([
            'id_status' => 2,
        ])
            ->limit(self::$num_article_user['side_recent'])
            ->orderBy('time_public', 'desc')
            ->get();

        return $articles;
    }

    public static function getPublicArticles()
    {
        $articles = Article::where([
          'id_status' => 2,
        ])
            ->latest()
            ->paginate(self::$num_article_user['home_list']);

        $articles = self::getAuthor($articles);
        return $articles;
    }

    public static function getPopularArticles()
    {
        $articles = Article::where([
            'id_status' => 2,
        ])
            ->orderBy('views', 'desc')
            ->limit(self::$num_article_user['side_popular'])
            ->get();

        return $articles;
    }

    public static function getTopArticles()
    {
        $articles = Article::where([
            'id_status' => 2,
            'top' => true,
        ])
            ->orderBy('time_public', 'desc')
            ->orderBy('views', 'desc')
            ->limit(self::$num_article_user['home_top'])
            ->get();

        $articles = self::getAuthor($articles);
        return $articles;
    }

    public static function saveImageThumbnail($request, $article){
        if($request->hasFile('thumbnail')){
            $fileExtension = $request->thumbnail->getClientOriginalExtension();

            $fileName = 'thumbnail_' . $article->id . "_" . time() . '.' . $fileExtension;
            $uploadPath = public_path('/files/' . Auth::user()->id);
            $request->file('thumbnail')->move($uploadPath, $fileName);
            $image = new Image();
            $image->url = "/files/". Auth::user()->id . "/" . $fileName;
            $image->save();
            $article->images()->attach(Image::where('id', $image->id)->get());
            return true;
        }
        return false;
    }

    public static function saveArticle(StoreArticle $request){
        $article = new Article();
        foreach ($request->only('title', 'content') as $key => $value){
            $article[$key] = $value;
        }
        $article['title-en'] = str_slug($request['title']);
        $article['id_author'] = Auth::user()->id;
        $article['summary'] = Article::getSummary($request['content']);
        if($date = DateTime::createFromFormat('H:i d.m.Y', $request['time_public'])){
            $article['time_public'] = $date->format('Y-m-d H:i:s');
        }
        else{
            return false;
        }
        $article->save();
        if($request->only('category')){
            $category_parent = Category::where('id', $request->only('category'))->first();
            $article->categories()->attach(Category::whereIn('id', [$category_parent->id, $category_parent->id_parent])->get());
        }

        return Article::saveImageThumbnail($request, $article);
    }

    public static function updateArticle($id, UpdateArticle $request){
        $article = Article::where([
            'id' => $id,
        ])->first();
        foreach ($request->only('title', 'content','status') as $key => $value){
            $article[$key] = $value;
        }
        $article['summary'] = Article::getSummary($request['content']);
        if($date = DateTime::createFromFormat('H:i d.m.Y', $request['time_public'])){
            $article['time_public'] = $date->format('Y-m-d H:i:s');
        }
        else{
            return false;
        }
        $article['id_status'] = 0;
        $article->save();
        $article->categories()->detach();
        if($request->only('category')){
            $category_parent = Category::where('id', $request->only('category'))->first();
            $article->categories()->attach(Category::whereIn('id', [$category_parent->id, $category_parent->id_parent])->get());
        }
        Article::saveImageThumbnail($request, $article);
        return true;
    }
    public static function updateArticleStatus($request){
        $request = json_decode($request, true);
        foreach ($request as $id => $status){
            $article = Article::where(['id' => $id])->first();
            $article['id_status'] = $status;
            $article->save();
        }
        return true;
    }
    public static function updateArticleStatusDaily(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $articles = Article::where([
            'id_status' => 1,
        ])->get();
        foreach($articles as $article){
            if(strtotime($article['time_public']) <= time()) {
                $article['id_status'] = 2;
                $article->save();
            }
        }
        return $articles ? true : false;
    }
    public static function updateArticleTop($request){
        $request = json_decode($request, true);
        $article = Article::where(['id' => $request['id']])->first();
        $article->top = !$article->top;
        return $article->save() ? true : false;
    }

    public static function searchFullText($request){
        $query = $request->only('query');

        if($query['query'] == null){
            return Article::getArticles();
        }
        $articles = Article::whereRaw('MATCH(title, content) AGAINST (? IN BOOLEAN MODE)', $query)
            ->paginate(20);
        foreach($articles as $article){
            $article['author'] = $article->author->name;
            $article['status'] = $article->status->name;
        }
        return $articles;
    }

    public static function searchFullTextUser($request){
        $query = $request->only('query');

        if($query['query'] == null){
            return Article::getArticles();
        }
        $articles = Article::whereRaw('MATCH(title, content) AGAINST (? IN BOOLEAN MODE)', $query)
            ->where('id_status', 2)
            ->paginate(self::$num_article_user['list_search']);
        foreach($articles as $article){
            $article['author'] = $article->author->name;
            $article['status'] = $article->status->name;
        }
        return $articles;
    }

    public static function searchFullTextForAuthor($request, $id){
        $query = $request->only('query');

        if($query['query'] == null){
            return Article::getArticles();
        }
        $articles = Article::whereRaw('MATCH(title, content) AGAINST (? IN BOOLEAN MODE)', $query)
            ->where('id_author', $id)
            ->paginate(20);
        foreach($articles as $article){
            $article['author'] = $article->author->name;
            $article['status'] = $article->status->name;
        }
        return $articles;
    }

    public static function getArticleContent($article){
        $article_content = Article::where([
            'title-en' => $article,
            'id_status' => 2,
        ])->first();
        if($article_content){
            $article_content['views'] += 1;
        }
        else{
            return false;
        }
        return $article_content->save() ? $article_content : [];
    }

    public static function getTimePublic(){
        $time_public = Article::selectRaw('date_format(time_public, \'%m-%Y\') as date')
            ->distinct()
            ->where([
                'id_status' => 2,
            ])
            ->get(['date']);
        foreach ($time_public as $time){
            $time->value = $time->date;
            $time->date = Carbon::parse('01-' . $time->date)->format('F, Y');
        }
        return $time_public;
    }

    public static function getArticleByTime($time){
        $time = strtotime('1-'.$time);
        $articles = Article::where([
                'id_status' => 2,
            ])
            ->whereMonth('time_public', date('m', $time))
            ->whereYear('time_public', date('Y', $time))
            ->paginate(self::$num_article_user['list_archie']);
        $articles = Article::getAuthor($articles);
        return $articles;
    }

    public static function getViewsOfMonth($time){
        $time = strtotime('1-'.$time);
        $views = Article::where([
            'id_status' => 2,
        ])
            ->whereMonth('time_public', date('m', $time))
            ->whereYear('time_public', date('Y', $time))
            ->sum('views');
        return $views;
    }

    public static function getSumOfArticlesOfMonth($time){
        $time = strtotime('1-'.$time);
        $sum_articles = Article::where([
            'id_status' => 2,
        ])
            ->whereMonth('time_public', date('m', $time))
            ->whereYear('time_public', date('Y', $time))
            ->count();
        return $sum_articles;
    }

    public static function getArticleLike($category_content, $article){
        if($article == null){
            $list_article = Article::where([
                'id_status' => 2,
            ])
                ->limit(self::$num_article_user['list_like'])
                ->orderBy('time_public', 'desc')
                ->get();
        }
        else {
            $category = Category::where([
                'name' => $category_content,
            ])->first();

            if ($category != null && $category->articles()->where('id_article', '!=', $article->id)->count() > 0) {
                $list_article = $category->articles()
                    ->where('id_article', '!=', $article->id)
                    ->where([
                        'id_status' => 2
                    ])
                    ->latest()
                    ->limit(self::$num_article_user['list_like'])
                    ->get();
            } else {
                $list_article = Article::where([
                    'id_status' => 2,
                ])
                    ->where('id', '!=', $article->id)
                    ->limit(self::$num_article_user['list_like'])
                    ->orderBy('time_public', 'desc')
                    ->get();
            }
        }
        return $list_article;
    }

    public static function getArticleByCategory($category)
    {
        $category = Category::where([
            'name' => $category,
        ])->first();
        $articles = [];
        if($category){
            $articles = $category->articles()
                ->where('id_status', 2)
                ->orderBy('time_public', 'desc')
                ->paginate(self::$num_article_user['list_category']);
            $articles = Article::getAuthor($articles);
        }
        return $articles;
    }

    public function author(){
        return $this->belongsTo('App\User', 'id_author', 'id');
    }
    public function categories(){
        return $this->belongsToMany('App\Category', 'article_category', 'id_article', 'id_category');
    }
    public function images(){
        return $this->belongsToMany('App\Image', 'article_image', 'id_article', 'id_image');
    }
    public function status(){
        return $this->hasOne('App\ArticleStatus', 'status_code', 'id_status');
    }
}
