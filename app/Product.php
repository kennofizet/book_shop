<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Authenticatable
{
    use Notifiable,Sluggable,CascadesDeletes;

    protected $cascadeDeletes = ['TypeProduct'];
    protected $table = "products";

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function Category()
    {
        return $this->belongsTo('App\Category','parent','id');
    }
    public function TypeProduct()
    {
        return $this->hasMany('App\TypeProduct','parent','id');
    }
}
