<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Bill extends Authenticatable
{
    use Notifiable;

    protected $table = "bills";
    
    public function Customer()
    {
        return $this->belongsTo('App\Customer','id_customer','id');
    }
    public function BillDetail()
    {
        return $this->hasMany('App\BillDetail','id_bill','id');
    }
}
