<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function getBlogList()
    {
        return view('admin.blog.list-post');
    }

    public function getBlogCreate()
    {
        return view('admin.blog.add-post');
    }

    public function getBlogCategoryList()
    {
        return view('admin.blog.list-category');
    }

   
}
