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

    public function articles(){
        return $this->belongsToMany('App\Article', 'article_category', 'id_category', 'id_article');
    }
}
