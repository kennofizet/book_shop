<?php

namespace App\Http\Controllers\Source\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function postSortProductCategory(Request $request)
    {
        $sort_by = (int)$request->sort_by;
        if (!empty($sort_by)) {
            $sort_by = (int)$sort_by;
            $redis = Redis::connection();
            if ($sort_by == 1) {
                // a->z
                $redis->set("source.api.user.".Auth::user()->id.".sort-product-category","a->z");
                return ['message' => "success"];
            }elseif ($sort_by == 2) {
                // z->a
                $redis->set("source.api.user.".Auth::user()->id.".sort-product-category","z->a");
                return ['message' => "success"];
            }elseif ($sort_by == 3) {
                // down
                $redis->set("source.api.user.".Auth::user()->id.".sort-product-category","down");
                return ['message' => "success"];
            }elseif ($sort_by == 4) {
                // up
                $redis->set("source.api.user.".Auth::user()->id.".sort-product-category","up");
                return ['message' => "success"];
            }else{
                return ['message' => "no_action"];
            }
        }else{
            return ['message' => "no_action"];
        };
    }
    public function postSortPriceProductCategory(Request $request)
    {
        $sort_price = (int)$request->sort_price;
        if (!empty($sort_price)) {
            $sort_price = (int)$sort_price;
            if ($sort_price == 1) {
                $request->session()->put('sort-price-product-category', 1);
                return ['message' => "success"];
            }elseif ($sort_price == 50000) {
                // < 50000 vnd
                $request->session()->put('sort-price-product-category', 50000);
                return ['message' => "success"];
            }elseif ($sort_price == 100000) {
                // 50000 - 100000 vnd
                $request->session()->put('sort-price-product-category', 100000);
                return ['message' => "success"];
            }elseif ($sort_price == 500000) {
                // 100000 - 500000 vnd
                $request->session()->put('sort-price-product-category', 500000);
                return ['message' => "success"];
            }elseif ($sort_price == 100000) {
                // 500000 - 1000000 vnd
                $request->session()->put('sort-price-product-category', 100000);
                return ['message' => "success"];
            }else{
                $request->session()->put('sort-price-product-category', 100001);
                return ['message' => "success"];
            }
        }else{
            return ['message' => "no_action"];
        };
    }
}
