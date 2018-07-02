<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'id_parent'
    ];
    protected $table = 'categories';

    public static function getCategory(){
        $categories = Category::whereNull('id_parent')->get();
        foreach($categories as $category){
            $category['count_articles'] = $category->articles->count() + Category::countArticlesParent($category->id);
            $category['child'] = Category::where('id_parent', $category->id)->get();
        }
        return $categories;
    }
    public static function saveCategory($request){
        if($request['isChild'] == true){
            return Category::create($request->only('name', 'id_parent'));
        }
        return Category::create($request->only('name'));
    }
    public static function updateCategory($request, $id){
        $category = Category::find($id);
        return $category->update($request->only('name', 'id_parent'));
    }

    public static function countArticlesParent($id){
        $category = Category::where(['id_parent' => $id])->get();
        $count = 0;
        foreach ($category as $item){
            $count += $item->articles->count();
        }
        return $count;
    }

    public static function getArticleBelong($category, $article){
        if($category != null && $category->articles()->where('id_article', '!=', $article->id)->count() > 0){
            $list_article = $category->articles()->where('id_article', '!=', $article->id)->latest()->limit(3)->get();
            //TODO : fix display hint
        }
        else{
            $list_article = Article::where([
                'id_status' => 2,

            ])
                ->where('id', '!=', $article->id)
                ->limit(3)
                ->orderBy('time_public', 'desc')
                ->get();
        }
        return $list_article;
    }

    public function articles(){
        return $this->belongsToMany('App\Article', 'article_category', 'id_category', 'id_article');
    }
}
