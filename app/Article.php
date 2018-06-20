<?php

namespace App;

use App\Http\Requests\StoreArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'content', 'id_author'];
    protected $table = 'articles';

    public static function saveArticle(StoreArticle $request){
        $article = new Article();
        foreach ($request->only('title', 'content') as $key => $value){
            $article[$key] = $value;
        }
        $article['id_author'] = Auth::user()->id;
        $article->categories()->attach(Category::whereIn('id', $request->only('category'))->get());
        return $article->save();
    }
    public function author(){
        return $this->belongsTo('App\User', 'id_author', 'id');
    }
    public function categories(){
        return $this->belongsToMany('App\Category', 'article_category', 'id_article', 'id_category');
    }
}
