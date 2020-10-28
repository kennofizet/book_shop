<?php

namespace App\Http\Controllers\Source\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\TypeProduct;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    public function postCreateProductCategory(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'title' => 'required',
            'status' => 'required'
        ]);
        if ($validator ->fails()) {
            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'There are incorect values in the form!',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }

            $this->throwValidationException(

                $request, $validator

            );
        }else{
            $title = $request->title;
            $status = $request->status;
            $parent = $request->parent;
            $id_user = Auth::user()->id;

            $new_category = new Category;
            $new_category->title = $title;
            $new_category->status = $status;
            if (!empty($parent)) {
                $new_category->parent = $parent;
            }else{
                $new_category->parent = 0;   
            }
            $new_category->st_c = 0;
            $new_category->id_user = $id_user;
            $new_category->save();

            return ['message' => "success"];
        }
    }
    public function postEditProductCategory(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required',
            'status' => 'required'
        ]);
        if ($validator ->fails()) {
            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'There are incorect values in the form!',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }

            $this->throwValidationException(

                $request, $validator

            );
        }else{
            $title = $request->title;
            $status = $request->status;
            $parent = $request->parent;
            $id = $request->id;
            if ($parent == $id) {
                // danger
                return ['message' => "success"];
            }else{
                try {
                    $category_edit = Category::findOrFail($id);
                } catch (ModelNotFoundException $ex) {
                    return redirect(route('admin.notfound'));
                }
                $category_edit->title = $title;
                $category_edit->status = $status;
                $category_edit->parent = $parent;
                $category_edit->update();

                return ['message' => "success"];
            }
        }
    }
    public function postCreateProduct(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'content' => 'required',
            'file' => 'required',
            'parent' => 'required',
            'style_file_x' => 'required',
            'style_file_y' => 'required',
            'style_file_w' => 'required',
            'style_file_h' => 'required'
        ]);
        if ($validator ->fails()) {
            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'There are incorect values in the form!',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }

            $this->throwValidationException(

                $request, $validator

            );
        }else{
            $image_x = floor($request->style_file_x);
            $image_y = floor($request->style_file_y);
            $image_w = floor($request->style_file_w);
            $image_h = floor($request->style_file_h);

            $name = $request->name;
            $price = $request->price;
            $description = $request->description;
            $content = $request->content;
            $parent = $request->parent;

             if ($request->hasFile('file')) {
                $file = $request->file;
                $file_extension = $file->getClientOriginalExtension(); 
                if($file_extension == 'png' or $file_extension == 'jpg' or $file_extension == 'jpeg' or $file_extension == 'PNG' or $file_extension == 'JPG' or $file_extension == 'JPEG'){
                    $file_name_old = $file->getClientOriginalName();
                    $file_name = Str::of($file_name_old)->replace(' ', '_')->replace("'", '_')->replace('.', '_')->replace('(', '')->replace(')', '');
                    $random_file_name = time().Str::random(20).'_'.$file_name;
                    while(file_exists('upload/source/api/product/images/'.$random_file_name))
                    {
                        $random_file_name = time().Str::random(20).'_'.$file_name;
                    }
                    $crop_file = Image::make($file);
                    if(!Storage::disk('public_upload')->put('source/api/product/images/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                    $crop_file->crop($image_w, $image_h, $image_x, $image_y);
                    $crop_file->resize(350,350);
                    if(!Storage::disk('public_upload')->put('source/api/product/thumbnail/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                    $crop_file->resize(700,700);
                    if(!Storage::disk('public_upload')->put('source/api/product/room-sezi/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                 
                }else{
                    return ['message' => 'file_error'];
                };

            }

            $new_post = new Product;
            $new_post->image = $random_file_name.".jpg";
            $new_post->name = $name;
            $new_post->description = $description;
            $new_post->content = $content;
            $new_post->price = $price;
            $new_post->sale_price = 0;
            $new_post->status_count = 1;
            $new_post->parent = $parent;
            // UIDID VALID RFC 4211 phiên bản 4 UUID
            $new_post->type = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x'.$parent,mt_Rand(0, 0xffff), mt_Rand(0, 0xffff),mt_Rand(0, 0xffff),mt_Rand(0, 0x0fff) | 0x4000,mt_Rand(0, 0x3fff) | 0x8000,mt_Rand(0, 0xffff), mt_Rand(0, 0xffff), mt_Rand(0, 0xffff));
            $new_post->save();
            return ['message' => "success"];
        }
    }
    public function postSettingCountDataPageProduct(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'number' => 'required',
        ]);
        if ($validator ->fails()) {
            return ["message" => "validator"];
        }else{
            $number = $request->number;
            if ($number == "default") {
                $new_number = 2;
            }elseif($number == "all"){
                $count_all_data = Product::all()->count();
                $new_number = $count_all_data;
            }elseif(intval($number) > 0){
                $new_number = $number;
            }else{
                return ['message' => "error"];
            }
            $redis = Redis::connection();
            $redis->set('source.api.admin.product.setting-count-data-page-product',$new_number);

            return ['message' => "success"];
        }
    }
    public function postSettingCategoryDataPageProduct(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'category' => 'required',
        ]);
        if ($validator ->fails()) {
            return ["message" => "validator"];
        }else{
            $id = $request->category;
            try {
                $category = Category::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return ['message' => "error"];
            }
            $redis = Redis::connection();
            $redis->set('source.api.admin.product.setting-category-data-page-product',$id);

            return ['message' => "success"];
        }
    }
    public function postNewProductSale(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator ->fails()) {
            return ["message" => "error"];
        }else{
            $id_product = $request->id;
            try {
                $product_update = Product::findOrFail($id_product);
            } catch (ModelNotFoundException $ex) {
                return ['message' => "error"];
            }
            if (!empty($request->price_sale)) {
                $validator  = Validator::make($request->all(), [
                    'price_sale' => 'numeric',
                ]);
                if ($validator ->fails()) {
                    if($request->ajax())
                    {
                        return response()->json(array(
                            'success' => false,
                            'message' => 'There are incorect values in the form!',
                            'errors' => $validator->getMessageBag()->toArray()
                        ), 422);
                    }

                    $this->throwValidationException(

                        $request, $validator

                    );
                }else{
                    $price_old = $product_update->price;
                    $price_sale = $request->price_sale;
                    if ($price_sale > $price_old) {
                        return ['message' => "validator-price"];
                    }
                    $product_update->sale_price = round($price_sale);
                    $product_update->update();
                    return ['message' => "success"];
                }
            }elseif (!empty($request->price_sale_price)) {
                $validator  = Validator::make($request->all(), [
                    'price_sale_price' => 'numeric',
                ]);
                if ($validator ->fails()) {
                    if($request->ajax())
                    {
                        return response()->json(array(
                            'success' => false,
                            'message' => 'There are incorect values in the form!',
                            'errors' => $validator->getMessageBag()->toArray()
                        ), 422);
                    }

                    $this->throwValidationException(

                        $request, $validator

                    );
                }else{
                    $price_old = $product_update->price;
                    $price_sale_price = $request->price_sale_price;
                    if ($price_sale_price > $price_old) {
                        return ['message' => "validator-price-sale"];
                    }
                    $product_update->sale_price = round($price_old) - round($price_sale_price);
                    $product_update->update();
                    return ['message' => "success"];
                }
            }elseif(!empty($request->price_sale_check)){
                $validator  = Validator::make($request->all(), [
                    'price_sale_check' => 'numeric',
                ]);
                if ($validator ->fails()) {
                    if($request->ajax())
                    {
                        return response()->json(array(
                            'success' => false,
                            'message' => 'There are incorect values in the form!',
                            'errors' => $validator->getMessageBag()->toArray()
                        ), 422);
                    }

                    $this->throwValidationException(

                        $request, $validator

                    );
                }else{
                    $price_old = $product_update->price;
                    $price_sale_check = $request->price_sale_check;
                    if ($price_sale_check > 100) {
                        return ['message' => "validator-price-check"];
                    }
                    $price_sale_like = ($price_sale_check*$price_old)/100;
                    $price_sale = $price_old - $price_sale_like;

                    $product_update->sale_price = round($price_sale);
                    $product_update->update();
                    return ['message' => "success"];
                }
            }else{
                return ['message' => "validator"];
            }
        }
    }
    public function postUnProductSale(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
            'action' => 'required',
        ]);
        if ($validator ->fails()) {
            return ["message" => "error"];
        }else{
            $id_product = $request->id;
            $action = $request->action;
            if ($action == "update") {
                try {
                    $product_update = Product::findOrFail($id_product);
                } catch (ModelNotFoundException $ex) {
                    return ['message' => "error"];
                }
                if (!empty($request->price_sale)) {
                    $validator  = Validator::make($request->all(), [
                        'price_sale' => 'numeric',
                    ]);
                    if ($validator ->fails()) {
                        if($request->ajax())
                        {
                            return response()->json(array(
                                'success' => false,
                                'message' => 'There are incorect values in the form!',
                                'errors' => $validator->getMessageBag()->toArray()
                            ), 422);
                        }

                        $this->throwValidationException(

                            $request, $validator

                        );
                    }else{
                        $price_old = $product_update->price;
                        $price_sale = $request->price_sale;
                        if ($price_sale > $price_old) {
                            return ['message' => "validator-price"];
                        }
                        $product_update->sale_price = round($price_sale);
                        $product_update->update();
                        return ['message' => "success"];
                    }
                }elseif (!empty($request->price_sale_price)) {
                $validator  = Validator::make($request->all(), [
                    'price_sale_price' => 'numeric',
                ]);
                if ($validator ->fails()) {
                    if($request->ajax())
                    {
                        return response()->json(array(
                            'success' => false,
                            'message' => 'There are incorect values in the form!',
                            'errors' => $validator->getMessageBag()->toArray()
                        ), 422);
                    }

                    $this->throwValidationException(

                        $request, $validator

                    );
                }else{
                    $price_old = $product_update->price;
                    $price_sale_price = $request->price_sale_price;
                    if ($price_sale_price > $price_old) {
                        return ['message' => "validator-price-sale"];
                    }
                    $product_update->sale_price = round($price_old) - round($price_sale_price);
                    $product_update->update();
                    return ['message' => "success"];
                }
            }elseif(!empty($request->price_sale_check)){
                    $validator  = Validator::make($request->all(), [
                        'price_sale_check' => 'numeric',
                    ]);
                    if ($validator ->fails()) {
                        if($request->ajax())
                        {
                            return response()->json(array(
                                'success' => false,
                                'message' => 'There are incorect values in the form!',
                                'errors' => $validator->getMessageBag()->toArray()
                            ), 422);
                        }

                        $this->throwValidationException(

                            $request, $validator

                        );
                    }else{
                        $price_old = $product_update->price;
                        $price_sale_check = $request->price_sale_check;
                        if ($price_sale_check > 100) {
                            return ['message' => "validator-price-check"];
                        }
                        $price_sale_like = ($price_sale_check*$price_old)/100;
                        $price_sale = $price_old - $price_sale_like;

                        $product_update->sale_price = round($price_sale);
                        $product_update->update();
                        return ['message' => "success"];
                    }
                }else{
                    return ['message' => "validator"];
                }
            }else if ($action == "sale") {
                try {
                    $product_update = Product::findOrFail($id_product);
                } catch (ModelNotFoundException $ex) {
                    return ['message' => "error"];
                }
                $product_update->sale_price = 0;
                $product_update->update();
                return ['message' => "success"];
            }else{
                return ["message" => "error"];
            }
        }
    }
    public function postNonProductStore(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator ->fails()) {
            return ["message" => "error"];
        }else{
            // chuyển sản phẩm sang hết hàng
            $id_product = $request->id;
            try {
                $product_update = Product::findOrFail($id_product);
            } catch (ModelNotFoundException $ex) {
                return ['message' => "error"];
            }
            $product_update->status_count = 0;
            $product_update->update();

            return ['message' => "success"];
        }
    }
    public function postHasProductStore(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator ->fails()) {
            return ["message" => "error"];
        }else{
            // chuyển sản phẩm sang hết hàng
            $id_product = $request->id;
            try {
                $product_update = Product::findOrFail($id_product);
            } catch (ModelNotFoundException $ex) {
                return ['message' => "error"];
            }
            $product_update->status_count = 1;
            $product_update->update();

            return ['message' => "success"];
        }
    }
    public function postDeleteProduct(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator ->fails()) {
            return ["message" => "error"];
        }else{
            $id_product = $request->id;
            try {
                $product_delete = Product::findOrFail($id_product);
            } catch (ModelNotFoundException $ex) {
                return ['message' => "error"];
            }
            $product_delete->delete();

            return ['message' => "success"];
        }
    }
    public function postProductCategoryDeleteById(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator ->fails()) {
            return ["message" => "error"];
        }else{
            $id_category = $request->id;
            try {
                $category_delete = Category::findOrFail($id_category);
            } catch (ModelNotFoundException $ex) {
                return ['message' => "error"];
            }
            $category_delete->delete();

            return ['message' => "success"];
        }
    }
    public function postEditProduct(Request $request)
    {
        // dd($request);
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'content' => 'required',
            'parent' => 'required',
        ]);
        if ($validator ->fails()) {
            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'There are incorect values in the form!',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }

            $this->throwValidationException(

                $request, $validator

            );
        }else{

            $image_x = floor($request->style_file_x);
            $image_y = floor($request->style_file_y);
            $image_w = floor($request->style_file_w);
            $image_h = floor($request->style_file_h);

            $id = $request->id;
            $name = $request->name;
            $price = $request->price;
            $description = $request->description;
            $content = $request->content;
            $parent = $request->parent;

            try {
                $update_post = Product::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return redirect(route('admin.notfound'));
            }

            $update_post->name = $name;
            $update_post->price = $price;
            $update_post->description = $description;
            $update_post->content = $content;
            $update_post->parent = $parent;

            if (!empty($request->file)) {
                // dùng ảnh mới
                $validator  = Validator::make($request->all(), [
                    'style_file_x' => 'required',
                    'style_file_y' => 'required',
                    'style_file_w' => 'required',
                    'style_file_h' => 'required',
                ]);
                if ($validator ->fails()) {
                    if($request->ajax())
                    {
                        return response()->json(array(
                            'success' => false,
                            'message' => 'There are incorect values in the form!',
                            'errors' => $validator->getMessageBag()->toArray()
                        ), 422);
                    }

                    $this->throwValidationException(

                        $request, $validator

                    );
                }else{
                    if ($request->hasFile('file')) {
                        $file = $request->file;
                        $file_extension = $file->getClientOriginalExtension(); 
                        if($file_extension == 'png' or $file_extension == 'jpg' or $file_extension == 'jpeg' or $file_extension == 'PNG' or $file_extension == 'JPG' or $file_extension == 'JPEG'){
                            $file_name_old = $file->getClientOriginalName();
                            $file_name = Str::of($file_name_old)->replace(' ', '_')->replace("'", '_')->replace('.', '_')->replace('(', '')->replace(')', '');
                            $random_file_name = time().Str::random(20).'_'.$file_name;
                            while(file_exists('upload/source/api/product/images/'.$random_file_name))
                            {
                                $random_file_name = time().Str::random(20).'_'.$file_name;
                            }
                            $crop_file = Image::make($file);
                            if(!Storage::disk('public_upload')->put('source/api/product/images/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                                return false;
                            }
                            $crop_file->crop($image_w, $image_h, $image_x, $image_y);
                            $crop_file->resize(350,350);
                            if(!Storage::disk('public_upload')->put('source/api/product/thumbnail/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                                return false;
                            }
                            $crop_file->resize(700,700);
                            if(!Storage::disk('public_upload')->put('source/api/product/room-sezi/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                                return false;
                            }
                         
                        }else{
                            return ['message' => 'file_error'];
                        };

                    }
                }
                $update_post->image = $random_file_name.".jpg";
            }else{
                if (!empty($image_x) and !empty($image_y) and !empty($image_w) and !empty($image_h)) {
                    $old_file_image_post = Product::find($id);
                    $crop_file = Image::make(Storage::disk('public_upload')->get('source/api/product/images/'.$old_file_image_post->image));
                    // thay đổi tên để tránh cache của trình duyệt
                    if(!Storage::disk('public_upload')->put('source/api/product/images/'.Str::replaceLast('.jpg','_',$old_file_image_post->image)."relife.jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                    $crop_file->crop($image_w, $image_h, $image_x, $image_y);
                    $crop_file->resize(350,350);
                    Storage::disk('public_upload')->delete('source/api/product/thumbnail/'.$old_file_image_post->image);
                    if(!Storage::disk('public_upload')->put('source/api/product/thumbnail/'.Str::replaceLast('.jpg','_',$old_file_image_post->image)."relife.jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                    $crop_file->resize(700,700);
                    if(!Storage::disk('public_upload')->put('source/api/product/room-sezi/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                    Storage::disk('public_upload')->delete('source/api/product/images/'.$old_file_image_post->image);
                    // dùng ảnh cũ nhưng cắt ảnh mới
                    $update_post->image = Str::replaceLast('.jpg','_',$old_file_image_post->image)."relife.jpg";
                }else{
                    // dùng ảnh cũ
                }
            }

            $update_post->update();
            return ['message' => "success"];
        }
    }
    public function postProductTypeCreate(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'file' => 'required',
            'seri' => 'required',
            'style_file_x' => 'required',
            'style_file_y' => 'required',
            'style_file_w' => 'required',
            'style_file_h' => 'required'
        ]);
        if ($validator ->fails()) {
            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'There are incorect values in the form!',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }

            $this->throwValidationException(

                $request, $validator

            );
        }else{
            $image_x = floor($request->style_file_x);
            $image_y = floor($request->style_file_y);
            $image_w = floor($request->style_file_w);
            $image_h = floor($request->style_file_h);

            $name = $request->name;
            $description = $request->description;
            $seri = $request->seri;
            try {
                $code_parent = Product::where('type',$seri)->firstOrFail();
            } catch (ModelNotFoundException $ex) {
                return ['message' => "code_fail"];
            }

             if ($request->hasFile('file')) {
                $file = $request->file;
                $file_extension = $file->getClientOriginalExtension(); 
                if($file_extension == 'png' or $file_extension == 'jpg' or $file_extension == 'jpeg' or $file_extension == 'PNG' or $file_extension == 'JPG' or $file_extension == 'JPEG'){
                    $file_name_old = $file->getClientOriginalName();
                    $file_name = Str::of($file_name_old)->replace(' ', '_')->replace("'", '_')->replace('.', '_')->replace('(', '')->replace(')', '');
                    $random_file_name = time().Str::random(20).'_'.$file_name;
                    while(file_exists('upload/source/api/product/type/images/'.$random_file_name))
                    {
                        $random_file_name = time().Str::random(20).'_'.$file_name;
                    }
                    $crop_file = Image::make($file);
                    if(!Storage::disk('public_upload')->put('source/api/product/type/images/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                    $crop_file->crop($image_w, $image_h, $image_x, $image_y);
                    $crop_file->resize(350,350);
                    if(!Storage::disk('public_upload')->put('source/api/product/type/thumbnail/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                    $crop_file->resize(700,700);
                    if(!Storage::disk('public_upload')->put('source/api/product/type/room-sezi/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                 
                }else{
                    return ['message' => 'file_error'];
                };

            }

            $new_post = new TypeProduct;
            $new_post->image = $random_file_name.".jpg";
            $new_post->name = $name;
            $new_post->parent = $code_parent->id;
            $new_post->description = $description;
            $new_post->save();
            return ['message' => "success"];
        }
    }
    public function postProductTypeDeleteById(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator ->fails()) {
            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'There are incorect values in the form!',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }

            $this->throwValidationException(

                $request, $validator

            );
        }else{
            $id = $request->id;
            try {
                $product_type_delete = TypeProduct::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return ['message' => "fail"];
            }
            $product_type_delete->delete();

            return ['message' => "success"];
        }
    }
    public function postSettingTypeDataPageProduct(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'number' => 'required',
        ]);
        if ($validator ->fails()) {
            return ["message" => "validator"];
        }else{
            $number = $request->number;
            if ($number == "default") {
                $new_number = 2;
            }elseif($number == "all"){
                $count_all_data = Product::all()->count();
                $new_number = $count_all_data;
            }elseif(intval($number) > 0){
                $new_number = $number;
            }else{
                return ['message' => "error"];
            }
            $redis = Redis::connection();
            $redis->set('source.api.admin.product.type.setting-count-data-page-product-type',$new_number);

            return ['message' => "success"];
        }
    }
}
