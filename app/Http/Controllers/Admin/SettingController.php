<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TemplateLoginSetting;
use Illuminate\Support\Facades\Redis;
use View;

class SettingController extends Controller
{

    public function __construct(Request $request)
    {

    }

    public function getSettingLogin()
    {
        $redis = Redis::connection();
        $count_rows_data_setting = $redis->get('source.api.admin.template.setting.setting-count-data-page-login');
        if (!empty($count_rows_data_setting)) {
            $count_rows_data_setting_new = $count_rows_data_setting;
        }else{
            $count_rows_data_setting_new = 5;
        }
        
        $list_setting_login = TemplateLoginSetting::orderBy('status','DESC')->paginate($count_rows_data_setting_new);
        $count_all = TemplateLoginSetting::all()->count();
        $count_active = TemplateLoginSetting::where('status',1)->count();
        $count_unactive = $count_all - $count_active;
        return view('admin.setting.login',[
            'list_setting_login' => $list_setting_login,
            'count_all' => $count_all,
            'count_active' => $count_active,
            'count_unactive' => $count_unactive
        ]);
    }
     public function getSettingLoginActive()
    {
        $redis = Redis::connection();
        $count_rows_data_setting = $redis->get('source.api.admin.template.setting.setting-count-data-page-login');
        if (!empty($count_rows_data_setting)) {
            $count_rows_data_setting_new = $count_rows_data_setting;
        }else{
            $count_rows_data_setting_new = 2;
        }

        $list_setting_login = TemplateLoginSetting::orderBy('status','DESC')->where('status',1)->paginate($count_rows_data_setting_new);
        $count_all = TemplateLoginSetting::all()->count();
        $count_active = TemplateLoginSetting::where('status',1)->count();
        $count_unactive = $count_all - $count_active;
        return view('admin.setting.login',[
            'list_setting_login' => $list_setting_login,
            'count_all' => $count_all,
            'count_active' => $count_active,
            'count_unactive' => $count_unactive
        ]);
    }
     public function getSettingLoginUnActive()
    {
        $redis = Redis::connection();
        $count_rows_data_setting = $redis->get('source.api.admin.template.setting.setting-count-data-page-login');
        if (!empty($count_rows_data_setting)) {
            $count_rows_data_setting_new = $count_rows_data_setting;
        }else{
            $count_rows_data_setting_new = 2;
        }

        $list_setting_login = TemplateLoginSetting::orderBy('status','DESC')->where('status',0)->paginate($count_rows_data_setting_new);
        $count_all = TemplateLoginSetting::all()->count();
        $count_active = TemplateLoginSetting::where('status',1)->count();
        $count_unactive = $count_all - $count_active;
        return view('admin.setting.login',[
            'list_setting_login' => $list_setting_login,
            'count_all' => $count_all,
            'count_active' => $count_active,
            'count_unactive' => $count_unactive
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSettingAddLogin()
    {
        return view('admin.setting.add-login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
