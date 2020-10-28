<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TypeProduct extends Authenticatable
{
    use Notifiable;

    protected $table = "type_products";

    public function Product()
    {
        return $this->belongsTo('App\Product','parent','id');
    }
}
