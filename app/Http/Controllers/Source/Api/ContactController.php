<?php

namespace App\Http\Controllers\Source\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InforWeb;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Jobs\EmailContact;

class ContactController extends Controller
{
    public function postSendNewContact(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);
        if ($validator ->fails()) {
            return ["message" => "validator"];
        }else{
            $name = $request->name;
            $email = $request->email;
            $title = $request->title;
            $content = $request->content;

            if (Auth::user()) {
                $id_user = Auth::user()->id;
                $name_user = Auth::user()->name;
            }else{
                $id_user = "ghost";
                $name_user = "Ghost";
            }
            $infor_web = InforWeb::orderBy('id','DESC')->first();
            EmailContact::dispatch($name,$infor_web->linkweb,$infor_web->address,$infor_web->name,$email,$title,"mail.contact","Có một liên hệ gửi đến bạn!",$content,$infor_web->email,$id_user,$name_user);
            return ["message" => "success"];
        }
    }
}
