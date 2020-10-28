<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\InforWeb;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use View;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    public function __construct()
      {
        $top_cart_product = Product::orderBy('total_cart','DESC')->limit(8)->get();
        $infor_web  = InforWeb::first();
        $list_category = Category::where('status','<>',0)->where('parent',0)->get();
        View::share('infor_web', $infor_web);
        View::share('list_category', $list_category);
        View::share('top_cart_product', $top_cart_product);
      }

    public function index()
    {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart->totalQty;
        }else{
            $count_item = 0;
        }
        $newest_product = Product::orderBy('id','DESC')->limit(8)->get();
        $random_product = Product::inRandomOrder()->limit(8)->get();
        return view('home.index',[
            'count_item' => $count_item,
            'random_product' => $random_product,
            'newest_product' => $newest_product
        ]);
    }

    public function getListProductByCategory($slug_category)
    {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart->totalQty;
        }else{
            $count_item = 0;
        }
        try {
            $category = Category::where('slug',$slug_category)->firstOrFail();
        } catch (ModelNotFoundException $ex) {
            return redirect(route('notfound'));
        }
        $session_sort = request()->session()->get("sort-price-product-category");
        // dd($session_sort);
        $redis = Redis::connection();
        if (Auth::user()) {
            $sort = $redis->get("source.api.user.".Auth::user()->id.".sort-product-category");
            if (!empty($sort)) {
                if ($sort == "a->z") {
                    $list_product = Product::where('parent',$category->id)->orderBy('name','ASC');
                    $sort_name = 1;
                }elseif ($sort == "z->a") {
                    $list_product = Product::where('parent',$category->id)->orderBy('name','DESC');
                    $sort_name = 2;
                }elseif ($sort == "down") {
                    $list_product = Product::where('parent',$category->id)->orderBy('price','DESC');
                    $sort_name = 3;
                }elseif ($sort == "up") {
                    $list_product = Product::where('parent',$category->id)->orderBy('price','ASC');
                    $sort_name = 4;
                }else{
                    $list_product = Product::where('parent',$category->id)->orderBy('id','DESC');
                    $sort_name = 0;
                };
            }else{
                $list_product = Product::where('parent',$category->id)->orderBy('id','DESC');
                $sort_name = 0;
            };
        }else{
            $list_product = Product::where('parent',$category->id)->orderBy('id','DESC');
            $sort_name = 0;
        };
        if (!empty($session_sort)) {
            if ($session_sort == 1) {
                // defalt sort
                $list_product_sort_end = $list_product->paginate(20);
                $count_product = $list_product->count();
            }elseif ($session_sort == 50000) {
                // < 50000 vnd
                $list_product_sort_end = $list_product->where('price','<',50000)->paginate(20);
                $count_product = $list_product->where('price','<',50000)->count();
            }elseif ($session_sort == 100000) {
                // 50000 -> 100000 vnd
                $list_product_sort_end = $list_product->where('price','>',50000)->where('price','<',100000)->paginate(20);
                $count_product = $list_product->where('price','>',50000)->where('price','<',100000)->count();
            }elseif ($session_sort == 500000) {
                // 100000 -> 500000 vnd
                $list_product_sort_end = $list_product->where('price','>',100000)->where('price','<',500000)->paginate(20);
                $count_product = $list_product->where('price','>',100000)->where('price','<',500000)->count();
            }elseif ($session_sort == 1000000) {
                // 500000 -> 1000000 vnd
                $list_product_sort_end = $list_product->where('price','>',500000)->where('price','<',1000000)->paginate(20);
                $count_product = $list_product->where('price','>',500000)->where('price','<',1000000)->count();
            }else{
                // > 1000000 vnd and other/ like customer edit session -> string, other number ....
                $list_product_sort_end = $list_product->where('price','>',1000000)->paginate(20);
                $session_sort = 1000001;
                $count_product = $list_product->where('price','>',1000000)->count();
            }
        }else{
            $list_product_sort_end = $list_product->paginate(20);
            $session_sort = 1;
            $count_product = $list_product->count();
        };
        
        return view('home.product-category',[
            'count_item' => $count_item,
            'sort_name' => $sort_name,
            'session_sort' => $session_sort,
            'count_product' => $count_product,
            'list_product' => $list_product_sort_end,
            'category' => $category
        ]);
    }

    public function getProductDetail($slug)
    {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart->totalQty;
        }else{
            $count_item = 0;
        }
        try {
            $detail_product = Product::where('slug',$slug)->firstOrFail();
        } catch (ModelNotFoundException $ex) {
            return redirect(route('notfound'));
        }
        $category_id = Category::where('id',$detail_product->parent)->pluck('id')->first();
        $product_near = Product::where('parent',$category_id)->orderBy('id','DESC')->limit(7)->get();
        return view('home.product-detail',[
            'count_item' => $count_item,
            'detail_product' => $detail_product,
            'product_near' => $product_near
        ]);
    }
    public function getCart()
    {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart->totalQty;
        }else{
            $count_item = 0;
        }
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $cart_list = $cart->items;
            $total_qty = $cart->totalQty;
            $total_price = $cart->totalPrice;
        }else{
            $cart_list = '';
            $total_qty = '';
            $total_price = '';
        };
        return view('home.cart',[
            'count_item' => $count_item,
            'cart_list' => $cart_list,
            'total_qty' => $total_qty,
            'total_price' => $total_price
        ]);
    }
    public function getCheckOut()
    {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart->totalQty;
        }else{
            $count_item = 0;
        }
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $cart_list = $cart->items;
            $total_qty = $cart->totalQty;
            $total_price = $cart->totalPrice;
        }else{
            $cart_list = '';
            $total_qty = '';
            $total_price = '';
        };
        return view('home.checkout',[
            'count_item' => $count_item,
            'cart_list' => $cart_list,
            'total_qty' => $total_qty,
            'total_price' => $total_price
        ]);
    }
    public function getContact()
    {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart->totalQty;
        }else{
            $count_item = 0;
        }
        return view('home.contact',['count_item' => $count_item]);
    }
    public function getAbout()
    {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart->totalQty;
        }else{
            $count_item = 0;
        }
        return view('home.about',['count_item' => $count_item]);
    }
    public function notFound()
    {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart->totalQty;
        }else{
            $count_item = 0;
        }
        return view('404-page',['count_item' => $count_item]);
    }
    public function getSearch($key)
    {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart->totalQty;
        }else{
            $count_item = 0;
        }
        $list_product = Product::orderBy('id','DESC')->where('name', 'like', '%' . $key . '%')->orWhere('description', 'like', '%' . $key . '%')->orWhere('content', 'like', '%' . $key . '%')->orWhere('price', 'like', '%' . $key . '%')->orWhere('sale_price', 'like', '%' . $key . '%')->limit(40)->get();
        return view('home.search',['list_product' => $list_product,'count_item' => $count_item]);
    }
    public function postSearch(Request $request)
    {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart->totalQty;
        }else{
            $count_item = 0;
        }
        $key = $request->key;
        $list_product = Product::orderBy('id','DESC')->where('name', 'like', '%' . $key . '%')->orWhere('description', 'like', '%' . $key . '%')->orWhere('content', 'like', '%' . $key . '%')->orWhere('price', 'like', '%' . $key . '%')->orWhere('sale_price', 'like', '%' . $key . '%')->limit(40)->get();
        if ($request->ajax()) {
            $view = view('home.search-pro-post',compact('list_product'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
