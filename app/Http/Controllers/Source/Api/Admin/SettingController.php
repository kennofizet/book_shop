<?php

namespace App\Http\Controllers\Source\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TemplateLoginSetting;
use Validator;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class SettingController extends Controller
{
    public function postSettingAddLogin(Request $request)
    {
    	$validator  = Validator::make($request->all(), [
            'name' => 'required',
            'title' => 'required',
            'file' => 'required',
            'status' => 'required'
        ]);
        if ($validator ->fails()) {
        	return ["message" => "validator"];
        }else{
        	$image_x = 0;
            $image_y = 0;
            $image_w = 100;
            $image_h = 100;
        	if ($request->status == 0) {
        		
        	} else {
        		// thay đổi những cái cũ thành ẩn và thực hiện hiện cái mới
        		$db_active_old = TemplateLoginSetting::where('status',1)->first();
        		if (!empty($db_active_old)) {
        			$db_active_old->status = 0;
	        		$db_active_old->update();
        		}
        	}
        	$new_setting_page_login = new TemplateLoginSetting;
        	$new_setting_page_login->status = $request->status;

        	if ($request->hasFile('file')) {

                $file = $request->file;
                $file_extension = $file->getClientOriginalExtension(); 
                if($file_extension == 'png' or $file_extension == 'jpg' or $file_extension == 'jpeg' or $file_extension == 'PNG' or $file_extension == 'JPG' or $file_extension == 'JPEG'){
                    $file_name_old = $file->getClientOriginalName();
                    $file_name = Str::of($file_name_old)->replace(' ', '_')->replace("'", '_')->replace('.', '_')->replace('(', '')->replace(')', '');
                    $random_file_name = time().Str::random(20).'_'.$file_name;
                    while(file_exists('upload/source/api/setting/page-login/images/'.$random_file_name))
                    {
                        $random_file_name = time().Str::random(20).'_'.$file_name;
                    }

                    $crop_file = Image::make($file);
                    if(!Storage::disk('public_upload')->put('source/api/setting/page-login/images/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                    $crop_file->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    if(!Storage::disk('public_upload')->put('source/api/setting/page-login/thumbnail/'.$random_file_name.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                }else{
                    return ['message' => 'file_error'];
                };

            }
            $new_setting_page_login->file = $random_file_name.".jpg";
        	$new_setting_page_login->title = $request->title;
        	$new_setting_page_login->name = $request->name;
        	$new_setting_page_login->save();
        	return ["message" => "success"];
        }
    }
    public function postSettingEditLogin(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
            'status_relax' => 'required',
        ]);
        if ($validator ->fails()) {
            return ["message" => "validator"];
        }else{
            if ($request->status_relax == 0) {
                return ['message' => "status_relax"];
            }elseif($request->status_relax == 1){
                // edit status 
                $old_active = TemplateLoginSetting::where('status',1)->first();
                if (!empty($old_active)) {
                    $old_active->status = 0;
                    $old_active->update();
                }

                $edit_setting_page_login = TemplateLoginSetting::find($request->id);
                $edit_setting_page_login->status = 1;
                $edit_setting_page_login->update();

                return ['message' => "update_success"];
            }elseif($request->status_relax == 2){
                $edit_setting_page_login = TemplateLoginSetting::find($request->id);
                $edit_setting_page_login->delete();
                return ['message' => "delete_success"];
            }else{

            };
        };
    }
    public function postSettingCountDataPageLogin(Request $request)
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
                $count_all_data = TemplateLoginSetting::all()->count();
                $new_number = $count_all_data;
            }elseif(intval($number) > 0){
                $new_number = $number;
            }else{
                return ['message' => "error"];
            }
            $redis = Redis::connection();
            $redis->set('source.api.admin.template.setting.setting-count-data-page-login',$new_number);

            return ['message' => "success"];
        }
    }
}
