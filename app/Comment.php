<?php

namespace App;

use App\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    
    public static function create($request){
        $request = json_decode($request);
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->content = $request->content;
        $comment->id_article = $request->id_article;

        return $comment->save() ? true : false;
    }
}