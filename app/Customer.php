<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = "customer";

    public function Bill()
    {
        return $this->belongsTo('App\Bill','id','id_customer');
    }

}
