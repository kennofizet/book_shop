<?php

namespace App\Http\Controllers\Source\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
use App\BlogPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends Controller
{
    public function postAddPost(Request $request)
    {
        // dd($request);
        $validator  = Validator::make($request->all(), [
            'content' => 'required',
            'title' => 'required',
            'title_content' => 'required',
            'content' => 'required',
            'status' => 'required',
            'file' => 'required',
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

            $title = $request->title;
            $title_content = $request->title_content;
            $content = $request->content;
            $status = $request->status;

             if ($request->hasFile('file')) {
                $file = $request->file;
                $file_extension = $file->getClientOriginalExtension(); 
                if($file_extension == 'png' or $file_extension == 'jpg' or $file_extension == 'jpeg' or $file_extension == 'PNG' or $file_extension == 'JPG' or $file_extension == 'JPEG'){
                    $file_name_old = $file->getClientOriginalName();
                    $file_name = Str::of($file_name_old)->replace(' ', '_')->replace("'", '_')->replace('.', '_')->replace('(', '')->replace(')', '');
                    $random_file_name = time().Str::random(20).'_'.$file_name;
                    while(file_exists('upload/source/api/blog/images/'.$random_file_name))
                    {
                        $random_file_name = time().Str::random(20).'_'.$file_name;
                    }
                    $crop_file = Image::make($file);
                    if(!Storage::disk('public_upload')->put('source/api/blog/images/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                    $crop_file->crop($image_w, $image_h, $image_x, $image_y);
                    $crop_file->resize(263,175);
                    if(!Storage::disk('public_upload')->put('source/api/blog/thumbnail/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                 
                }else{
                    return ['message' => 'file_error'];
                };

            }

            $new_post = new BlogPost;
            $new_post->file = $random_file_name.".jpg";
            $new_post->title = $title;
            $new_post->title_content = $title_content;
            $new_post->content = $content;
            $new_post->status = $status;
            $new_post->id_user = Auth::user()->id;
            $new_post->save();
            return ['message' => "success"];
        }

    }
    public function postSettingCountDataPageBlog(Request $request)
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
                $count_all_data = BlogPost::all()->count();
                $new_number = $count_all_data;
            }elseif(intval($number) > 0){
                $new_number = $number;
            }else{
                return ['message' => "error"];
            }
            $redis = Redis::connection();
            $redis->set('source.api.admin.blog.setting-count-data-page-login',$new_number);

            return ['message' => "success"];
        }
    }
    public function postDeletePost(Request $request)
    {
         $validator  = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator ->fails()) {
            return ["message" => "validator"];
        }else{
            $post = BlogPost::where('id',$request->id)->first();
            $post->delete();
            return ['message' => "success"];
        }
    }
    public function postEditPost(Request $request)
    {
        // dd($request);
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
            'content' => 'required',
            'title' => 'required',
            'title_content' => 'required',
            'status' => 'required',
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

            $title = $request->title;
            $title_content = $request->title_content;
            $content = $request->content;
            $status = $request->status;
            $id = $request->id;

            try {
                $update_post = BlogPost::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return redirect(route('admin.notfound'));
            }

            $update_post->title = $title;
            $update_post->title_content = $title_content;
            $update_post->content = $content;
            $update_post->status = $status;

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
                            while(file_exists('upload/source/api/blog/images/'.$random_file_name))
                            {
                                $random_file_name = time().Str::random(20).'_'.$file_name;
                            }
                            $crop_file = Image::make($file);
                            if(!Storage::disk('public_upload')->put('source/api/blog/images/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                                return false;
                            }
                            $crop_file->crop($image_w, $image_h, $image_x, $image_y);
                            $crop_file->resize(263,175);
                            if(!Storage::disk('public_upload')->put('source/api/blog/thumbnail/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                                return false;
                            }
                         
                        }else{
                            return ['message' => 'file_error'];
                        };

                    }
                }
                $update_post->file = $random_file_name.".jpg";
            }else{
                if (!empty($image_x) and !empty($image_y) and !empty($image_w) and !empty($image_h)) {
                    $old_file_image_post = BlogPost::find($id);
                    $crop_file = Image::make(Storage::disk('public_upload')->get('source/api/blog/images/'.$old_file_image_post->file));
                    // thay đổi tên để tránh cache của trình duyệt
                    if(!Storage::disk('public_upload')->put('source/api/blog/images/'.Str::replaceLast('.jpg','_',$old_file_image_post->file)."relife.jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                    $crop_file->crop($image_w, $image_h, $image_x, $image_y);
                    $crop_file->resize(263,175);
                    Storage::disk('public_upload')->delete('source/api/blog/thumbnail/'.$old_file_image_post->file);
                    if(!Storage::disk('public_upload')->put('source/api/blog/thumbnail/'.Str::replaceLast('.jpg','_',$old_file_image_post->file)."relife.jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                    Storage::disk('public_upload')->delete('source/api/blog/images/'.$old_file_image_post->file);
                    // dùng ảnh cũ nhưng cắt ảnh mới
                    $update_post->file = Str::replaceLast('.jpg','_',$old_file_image_post->file)."relife.jpg";
                }else{
                    // dùng ảnh cũ
                }
            }

            $update_post->update();
            return ['message' => "success"];
        }
    }
}
