<?php

namespace App;

use App\Http\Requests\StoreArticle;
use App\Http\Requests\UpdateArticle;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'content', 'id_author'];
    protected $table = 'articles';

    private static function getSummary($content){
        $summary = preg_replace("/<[^>]*>/","", $content);
        return $summary;
    }

    public static function getArticles(){
        $articles = Article::latest()->paginate(20);
        foreach ($articles as $article){
            $article['author'] = $article->author->name;
            $article['status'] = $article->status->name;
        }
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
        $article['id_author'] = Auth::user()->id;
        $article['summary'] = Article::getSummary($request['content']);
        if($date = DateTime::createFromFormat('H:i d.m.Y', $request['time_public'])){
            $article['time_public'] = $date->format('Y-m-d H:i:s');
        }
        else{
            return false;
        }
        $article->save();
        $article->categories()->attach(Category::whereIn('id', $request->only('category'))->get());

         return Article::saveImageThumbnail($request, $article);
    }

    public static function updateArticle($id, UpdateArticle $request){
        $article = Article::where([
            'id' => $id,
        ])->first();
        foreach ($request->only('title', 'content') as $key => $value){
            $article[$key] = $value;
        }
        $article['summary'] = Article::getSummary($request['content']);
        if($date = DateTime::createFromFormat('H:i d.m.Y', $request['time_public'])){
            $article['time_public'] = $date->format('Y-m-d H:i:s');
        }
        else{
            return false;
        }
        $article->save();
        $article->categories()->attach(Category::whereIn('id', $request->only('category'))->get());
        Article::saveImageThumbnail($request, $article);
        return true;
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
