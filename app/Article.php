<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public function comment()
    {
    return $this->hasMany('App\Comment');
    }
    public function like()
    {
    return $this->hasMany('App\Like');
    }
      
    public function user()
    {
    return $this->belongsTo('App\User');
    }
    public function best_articles()
    {
    return $this->hasMany('App\Best_article');
    }
 }
