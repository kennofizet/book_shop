<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('home.index',[
            'test_category' => "abc"
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
