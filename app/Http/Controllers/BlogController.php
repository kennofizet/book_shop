<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use View;
use App\Category;
use App\InforWeb;
use Session;
use App\Product;

class BlogController extends Controller
{
    public function __construct()
      {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart['totalQty'];
        }else{
            $count_item = 0;
        }
        $top_cart_product = Product::orderBy('total_cart','DESC')->limit(8)->get();
        $infor_web  = InforWeb::first();
        $list_category = Category::where('status','<>',0)->where('parent',0)->get();
        View::share('count_item', $count_item);
        View::share('infor_web', $infor_web);
        View::share('list_category', $list_category);
        View::share('top_cart_product', $top_cart_product);
      }

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
