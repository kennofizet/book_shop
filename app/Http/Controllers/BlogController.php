<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getBlog()
    {
        return view('home.blog');
    }
    public function getBlogDetail()
    {
        return view('home.blog-detail');
    }
}
