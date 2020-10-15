<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class InforWeb extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "infor_web";

    // protected $fillable = [
    //     'name', 'email', 'password', 'firstname', 'lastname', 'age', 'image', 'address', 'email_verified_at','confirmation_code','parent_verifi_email'
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function User()
    {
        return $this->belongsTo('App\User','email','email');
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
