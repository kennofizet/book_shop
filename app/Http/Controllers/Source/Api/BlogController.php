<?php

namespace App\Http\Controllers\Source\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogPostLikeableLike;
use App\BlogPostLikeableLikeCounter;
use App\BlogPost;
use LRedis;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function postLikePost(Request $request)
    {
        $slug_post = $request->post;
        $check_post = BlogPost::where('slug',$slug_post)->first();
        if (!empty($check_post)) {
            $post = $check_post;
            $redis_check_like_user = LRedis::connection();
            $redis_time_check = $redis_check_like_user->get('blog:post:'.$post->id.':user:like:'.Auth::User()->id);
            if (!empty($redis_time_check)) {
                if ((new Carbon($redis_time_check))->addSeconds(3) < Carbon::now()) {
                    $redis_time_check = $redis_check_like_user->set('blog:post:'.$post->id.':user:like:'.Auth::User()->id,Carbon::now());
                    $check_time = "true";
                }else{
                    return ['message' => "wait"];
                }
            }else{
                $redis_time_check = $redis_check_like_user->set('blog:post:'.$post->id.':user:like:'.Auth::User()->id,Carbon::now());
                $check_time = "true";
            };
            if ($check_time == "true") {
                $check_like_parent = BlogPostLikeableLikeCounter::where('id_post',$post->id)->where('type',1)->first();
                if (!empty($check_like_parent)) {
                    
                }else{
                    $new_like_parent = new BlogPostLikeableLikeCounter;
                    $new_like_parent->id_post = $post->id;
                    $new_like_parent->type = 1;
                    $new_like_parent->count = 0;
                    $new_like_parent->save();
                };
                $check_like = BlogPostLikeableLike::where('type',1)->where('id_user',Auth::user()->id)->where('id_post',$post->id)->first();
                if (!empty($check_like)) {
                    $count_like = BlogPostLikeableLikeCounter::where('id_post',$post->id)->where('type',1)->first();
                    $update_count_like = BlogPostLikeableLikeCounter::find($count_like->id);
                    $update_count_like->count = $count_like->count - 1;
                    $update_count_like->update();
                    $check_like->delete();
                    return ['message' => 'un-like','slug' => $slug_post, 'like' => $count_like->count - 1];
                }else{
                    $count_like = BlogPostLikeableLikeCounter::where('id_post',$post->id)->where('type',1)->first();
                    $update_count_like = BlogPostLikeableLikeCounter::find($count_like->id);
                    $update_count_like->count = $count_like->count + 1;
                    $update_count_like->update();

                    $new_like_post = new BlogPostLikeableLike;
                    $new_like_post->id_post = $post->id;
                    $new_like_post->type = 1;
                    $new_like_post->id_user = Auth::user()->id;
                    $new_like_post->save();
                    return ['message' => 'like', 'slug' => $slug_post, 'like' => $count_like->count + 1];
                }
            }
        }
    }
}
