<?php

namespace App;

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
        if(isset($request->id_parent)) {
            $comment->id_parent = $request->id_parent;
        }
        return $comment->save() ? true : false;
    }

    public function child() {
        return $this->hasMany('App\Comment', 'id_parent', 'id');
    }

    public static function getComments($id_article) {
        $comments = Comment::whereNull('id_parent')
            ->where([
                'id_article' => $id_article
            ])
            ->with('child')
            ->orderBy('created_at', 'desc')
            ->get();
        return $comments;
    }
    public static function getCountComments($comments) {
        $count = count($comments);
        foreach($comments as $comment){
            $count += count($comment->child);
        }
        return $count;
    }
}