<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Authenticatable
{
    use Notifiable,Sluggable,CascadesDeletes;

    protected $cascadeDeletes = ['blogPostLikeableLike','blogPostLikeableLikeCounter'];
    protected $table = "blog_post";

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function countLikePost()
    {
        return $this->belongsTo('App\BlogPostLikeableLikeCounter','id','id_post');
    }
    public function blogPostLikeableLikeCounter()
    {
        return $this->hasMany('App\BlogPostLikeableLikeCounter','id_post','id');
    }
    public function blogPostLikeableLike()
    { 
        return $this->hasMany('App\BlogPostLikeableLike','id_post','id');
    }
}
