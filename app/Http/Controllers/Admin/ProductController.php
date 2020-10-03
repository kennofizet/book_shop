<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductList()
    {
        return view('admin.product.list');
    }
    public function getProductCreate()
    {
        return view('admin.product.add-product');
    }

    public function getProductCategoryList()
    {
        return view('admin.product.list-category');
    }
}
