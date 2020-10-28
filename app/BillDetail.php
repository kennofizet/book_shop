<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BillDetail extends Authenticatable
{
    use Notifiable;

    protected $table = "bill_detail";

    public function Product()
    {
        return $this->belongsTo('App\Product','id_product','id');
    }
}
