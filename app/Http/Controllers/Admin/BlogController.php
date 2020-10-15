<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogPost;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends Controller
{

    public function getBlogList()
    {
        $redis = Redis::connection();
        $count_rows_data_setting = $redis->get('source.api.admin.blog.setting-count-data-page-login');
        if (!empty($count_rows_data_setting)) {
            $count_rows_data_setting_new = $count_rows_data_setting;
        }else{
            $count_rows_data_setting_new = 5;
        }

        $list_post = BlogPost::orderBy('id','DESC')->paginate($count_rows_data_setting_new);
        $count_all = BlogPost::all()->count();
        $count_active = BlogPost::where('status',1)->count();
        $count_hidden = BlogPost::where('status',0)->count();
        return view('admin.blog.list-post',[
            'list_post' => $list_post,
            'count_all'=>$count_all,
            'count_active'=>$count_active,
            'count_hidden'=>$count_hidden
        ]);
    }
    public function getBlogListActive()
    {
        $redis = Redis::connection();
        $count_rows_data_setting = $redis->get('source.api.admin.blog.setting-count-data-page-login');
        if (!empty($count_rows_data_setting)) {
            $count_rows_data_setting_new = $count_rows_data_setting;
        }else{
            $count_rows_data_setting_new = 2;
        }

        $list_post = BlogPost::orderBy('status','DESC')->where('status',1)->paginate($count_rows_data_setting_new);
        $count_all = BlogPost::all()->count();
        $count_active = BlogPost::where('status',1)->count();
        $count_hidden = $count_all - $count_active;
        return view('admin.blog.list-post',[
            'list_post' => $list_post,
            'count_all' => $count_all,
            'count_active' => $count_active,
            'count_hidden' => $count_hidden
        ]);
    }
     public function getBlogListHidden()
    {
        $redis = Redis::connection();
        $count_rows_data_setting = $redis->get('source.api.admin.blog.setting-count-data-page-login');
        if (!empty($count_rows_data_setting)) {
            $count_rows_data_setting_new = $count_rows_data_setting;
        }else{
            $count_rows_data_setting_new = 2;
        }

        $list_post = BlogPost::orderBy('status','DESC')->where('status',0)->paginate($count_rows_data_setting_new);
        $count_all = BlogPost::all()->count();
        $count_active = BlogPost::where('status',1)->count();
        $count_hidden = $count_all - $count_active;
        return view('admin.blog.list-post',[
            'list_post' => $list_post,
            'count_all' => $count_all,
            'count_active' => $count_active,
            'count_hidden' => $count_hidden
        ]);
    }
    public function getBlogCreate()
    {
        return view('admin.blog.add-post');
    }

    public function getBlogCategoryList()
    {
        return view('admin.blog.list-category');
    }
    public function getEditPost($id)
    {
        try {
            $post = BlogPost::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return redirect(route('admin.notfound'));
        }
        return view('admin.blog.edit-post',['detail_post' => $post]);
    }
   
}
