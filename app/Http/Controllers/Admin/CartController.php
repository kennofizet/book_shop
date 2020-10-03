<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCartList()
    {
        return view('admin.cart.list');
    }
    public function getCartListCustomer()
    {
        return view('admin.cart.list-customer');
    }
}
