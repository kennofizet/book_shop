<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{

    public function index()
    {
        $list_category = Category::where('status','<>',0)->where('parent',0)->get();
        return view('home.index',[
            'list_category' => $list_category
        ]);
    }

    public function getListProductByCategory($slug_category)
    {
        return view('home.product-category',[
            'slug_category' => $slug_category
        ]);
    }

    public function getProductDetail($id_product)
    {
        $test = $id_product;
        return view('home.product-detail',[
            'test' => $test,
        ]);
    }
    public function getCart()
    {
        return view('home.cart');
    }
    public function getCheckOut()
    {
        return view('home.checkout');
    }
    public function getContact()
    {
        return view('home.contact');
    }
    public function getAbout()
    {
        return view('home.about');
    }
    public function notFound()
    {
        return view('404-page');
    }
}
