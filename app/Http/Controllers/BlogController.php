<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;

class BlogController extends Controller
{
    public function getBlog()
    {
    	$list_post = BlogPost::orderBy('id','DESC')->where('status',1)->paginate(6);
        return view('home.blog',[
        	'list_post' => $list_post
        ]);
    }
    public function getBlogDetail($slug)
    {
    	$post_detail = BlogPost::where('slug',$slug)->first();
    	if (!empty($post_detail)) {
    		return view('home.blog-detail',[
    			'post_detail' => $post_detail
    		]);
    	}else{
    		return redirect(route('notfound'));
    	}
    }
}
