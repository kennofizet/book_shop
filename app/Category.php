<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable
{
    use Notifiable,Sluggable;

    protected $table = "category";

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function User()
    {
        return $this->belongsTo('App\User','id_user','id');
    }
    public function Parent()
    {
        return $this->belongsTo('App\Category','parent','id');
    }
    public function Child()
    {
        return $this->hasMany('App\Category','parent','id');
    }
    public function Product()
    {
        return $this->hasMany('App\Product','parent','id');
    }

}
