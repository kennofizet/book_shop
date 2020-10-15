<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BlogPostLikeableLike extends Authenticatable
{
    use Notifiable;

    protected $table = "blog_post_likeable_like";

}
