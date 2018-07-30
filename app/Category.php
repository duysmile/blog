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

    public function child()
    {
        return $this->hasMany('App\Category', 'id_parent', 'id');
    }
    public static function getCategory(){
        $categories = Category::whereNull('id_parent')->with('child')->get();
//        code above is similar to the block below
//        foreach($categories as $category){
//            $category['count_articles'] = $category->articles->count() + Category::countArticlesParent($category->id);
//            $category['child'] = Category::where('id_parent', $category->id)->get();
//        }
        foreach($categories as $category){
            $category['count_articles'] = $category->articles->count() + Category::countArticlesParent($category->id);
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

    public function articles(){
        return $this->belongsToMany('App\Article', 'article_category', 'id_category', 'id_article');
    }
}
