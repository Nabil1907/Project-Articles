<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function article()
    {
    return $this->hasMany('App\Article');
    }
    public function likes()
    {
    return $this->hasMany('App\Like');
    }
    public function comments()
    {
    return $this->hasMany('App\Comment');
    }
    public function best_articles()
    {
    return $this->hasMany('App\Best_article');
    }
}
