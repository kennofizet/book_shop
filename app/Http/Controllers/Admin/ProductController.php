<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\TypeProduct;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Redis;
use View;

class ProductController extends Controller
{
    public function postSearchProduct(Request $request)
    {
        $key = $request->key;
        $list_product = Product::orderBy('id','DESC')->where('name', 'like', '%' . $key . '%')->orWhere('description', 'like', '%' . $key . '%')->orWhere('content', 'like', '%' . $key . '%')->orWhere('price', 'like', '%' . $key . '%')->orWhere('sale_price', 'like', '%' . $key . '%')->paginate(10);
        // dd($key);
        if ($request->ajax()) {
            $view = view('admin.product.list-search',compact('list_product'))->render();
            return response()->json(['html'=>$view]);
        }
    }
    public function postSearchProductType(Request $request)
    {
        $key = $request->key;
        $list_type = TypeProduct::orderBy('id','DESC')->where('name', 'like', '%' . $key . '%')->orWhere('description', 'like', '%' . $key . '%')->paginate(10);
        // dd($key);
        if ($request->ajax()) {
            $view = view('admin.product.list-type-search',compact('list_type'))->render();
            return response()->json(['html'=>$view]);
        }
    }
    public function getProductList()
    {
        $redis = Redis::connection();
        $count_rows_data_setting = $redis->get('source.api.admin.product.setting-count-data-page-product');
        $category_data_setting = $redis->get('source.api.admin.product.setting-category-data-page-product');
        if (!empty($count_rows_data_setting)) {
            $count_rows_data_setting_new = $count_rows_data_setting;
        }else{
            $count_rows_data_setting_new = 5;
        }
        if (!empty($category_data_setting)) {
            $list_product = Product::orderBy('id','DESC')->where('parent',$category_data_setting)->paginate($count_rows_data_setting_new);
            $redis->del('source.api.admin.product.setting-category-data-page-product');
            $category_active = $category_data_setting;
        }else{
            $list_product = Product::orderBy('id','DESC')->paginate($count_rows_data_setting_new);
            $category_active = 0;
        }
        $count_all = Product::all()->count();
        $list_category = Category::where('parent',0)->get();
        $count_active = Product::where('status_count',1)->count();
        $count_hidden = Product::where('status_count',0)->count();
        return view('admin.product.list',[
            'list_product' => $list_product,
            'category_active' => $category_active,
            'count_rows_data_setting_new' => $count_rows_data_setting_new,
            'list_category' => $list_category,
            'count_active' => $count_active,
            'count_hidden' => $count_hidden,
            'count_all' => $count_all
        ]);
    }
    public function getProductListActive()
    {
        $redis = Redis::connection();
        $count_rows_data_setting = $redis->get('source.api.admin.product.setting-count-data-page-product');
        $category_data_setting = $redis->get('source.api.admin.product.setting-category-data-page-product');
        if (!empty($count_rows_data_setting)) {
            $count_rows_data_setting_new = $count_rows_data_setting;
        }else{
            $count_rows_data_setting_new = 5;
        }
        if (!empty($category_data_setting)) {
            $list_product = Product::orderBy('id','DESC')->where('parent',$category_data_setting)->paginate($count_rows_data_setting_new);
            $redis->del('source.api.admin.product.setting-category-data-page-product');
            $category_active = $category_data_setting;
        }else{
            $list_product = Product::orderBy('id','DESC')->where('status_count',1)->paginate($count_rows_data_setting_new);
            $category_active = 0;
        }
        $count_all = Product::all()->count();
        $list_category = Category::where('parent',0)->get();
        $count_active = Product::where('status_count',1)->count();
        $count_hidden = Product::where('status_count',0)->count();
        return view('admin.product.list',[
            'list_product' => $list_product,
            'category_active' => $category_active,
            'count_rows_data_setting_new' => $count_rows_data_setting_new,
            'list_category' => $list_category,
            'count_active' => $count_active,
            'count_hidden' => $count_hidden,
            'count_all' => $count_all
        ]);
    }
    public function getProductListHidden()
    {
        $redis = Redis::connection();
        $count_rows_data_setting = $redis->get('source.api.admin.product.setting-count-data-page-product');
        $category_data_setting = $redis->get('source.api.admin.product.setting-category-data-page-product');
        if (!empty($count_rows_data_setting)) {
            $count_rows_data_setting_new = $count_rows_data_setting;
        }else{
            $count_rows_data_setting_new = 5;
        }
        if (!empty($category_data_setting)) {
            $list_product = Product::orderBy('id','DESC')->where('parent',$category_data_setting)->paginate($count_rows_data_setting_new);
            $redis->del('source.api.admin.product.setting-category-data-page-product');
            $category_active = $category_data_setting;
        }else{
            $list_product = Product::orderBy('id','DESC')->where('status_count',0)->paginate($count_rows_data_setting_new);
            $category_active = 0;
        }
        $count_all = Product::all()->count();
        $list_category = Category::where('parent',0)->get();
        $count_active = Product::where('status_count',1)->count();
        $count_hidden = Product::where('status_count',0)->count();
        return view('admin.product.list',[
            'list_product' => $list_product,
            'category_active' => $category_active,
            'count_rows_data_setting_new' => $count_rows_data_setting_new,
            'list_category' => $list_category,
            'count_active' => $count_active,
            'count_hidden' => $count_hidden,
            'count_all' => $count_all
        ]);
    }
    public function getProductCreate()
    {
        $list_category = Category::where('status',1)->where('parent',0)->get();
        // dd($list_category);
        return view('admin.product.add-product',['list_category' => $list_category]);
    }

    public function getProductCategoryList()
    {
        $list_category = Category::where('parent',0)->get();
        return view('admin.product.list-category',['list_category' => $list_category]);
    }
    public function getProductCategoryCreate()
    {
        $list_category = Category::all();
        return view('admin.product.add-category',['list_category' => $list_category]);
    }
    public function getProductCategoryEdit($id)
    {
        try {
            $get_category = Category::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return redirect(route('admin.notfound'));
        }
        $list_category = Category::where('id','<>',$id)->get();
        return view('admin.product.edit-category',['category_detail' => $get_category,'list_category' => $list_category]);
    }
    public function getProductEdit($id)
    {
        try {
            $get_product = Product::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return redirect(route('admin.notfound'));
        }
        $list_category = Category::all();
        return view('admin.product.edit',['product_detail' => $get_product,'list_category' => $list_category]);
    }
    public function getProductTypeList()
    {
        $redis = Redis::connection();
        $count_rows_data_setting = $redis->get('source.api.admin.product.type.setting-count-data-page-product-type');
        if (!empty($count_rows_data_setting)) {
            $count_rows_data_setting_new = $count_rows_data_setting;
        }else{
            $count_rows_data_setting_new = 5;
        }

        $list_type = TypeProduct::orderBy('id','DESC')->paginate($count_rows_data_setting_new);
        $count_all = TypeProduct::all()->count();
        return view('admin.product.list-type-product',['list_type' => $list_type,'count_rows_data_setting_new' => $count_rows_data_setting_new,'count_all' => $count_all]);
    }
    public function getProductTypeCreate()
    {
        return view('admin.product.add-type-product');
    }
}
