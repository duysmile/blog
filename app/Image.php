<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function articles(){
        return $this->belongsToMany('App\Article', 'article_image', 'id_image', 'id_article');
    }
}
