<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AccountController extends Controller
{
    public function myAcccount()
    {
        return view('admin.account.my-account.index');
    }
    public function listAccountActive()
    {
        $list_account = User::orderBy('id','DESC')->where('parent_verifi_email',1)->paginate(10);
        $count_all_account = User::all()->count();
        $count_active_account = User::where('parent_verifi_email',1)->count();
        $count_wait_account = User::where('parent_verifi_email',0)->count();
        return view('admin.account.list',[
            'list_account' => $list_account,
            'count_all_account' => $count_all_account,
            'count_wait_account' => $count_wait_account,
            'count_active_account' => $count_active_account
        ]);
    }
    public function listAccountWait()
    {
        $list_account = User::orderBy('id','DESC')->where('parent_verifi_email',0)->paginate(10);
        $count_all_account = User::all()->count();
        $count_active_account = User::where('parent_verifi_email',1)->count();
        $count_wait_account = User::where('parent_verifi_email',0)->count();
        return view('admin.account.list',[
            'list_account' => $list_account,
            'count_all_account' => $count_all_account,
            'count_wait_account' => $count_wait_account,
            'count_active_account' => $count_active_account
        ]);
    }
    public function myAcccountChangePassword()
    {
    	return view('admin.account.my-account.change-password');
    }
    public function listAccount()
    {
    	$list_account = User::orderBy('id','DESC')->paginate(10);
    	$count_all_account = User::all()->count();
    	$count_active_account = User::where('parent_verifi_email',1)->count();
    	$count_wait_account = User::where('parent_verifi_email',0)->count();
    	return view('admin.account.list',[
    		'list_account' => $list_account,
    		'count_all_account' => $count_all_account,
    		'count_wait_account' => $count_wait_account,
    		'count_active_account' => $count_active_account
    	]);
    }
    public function postSearchAccount(Request $request)
    {
    	$key = $request->key;
        $list_account = User::orderBy('id','DESC')->where('name', 'like', '%' . $key . '%')->orWhere('email', 'like', '%' . $key . '%')->orWhere('address', 'like', '%' . $key . '%')->orWhere('phone', 'like', '%' . $key . '%')->orWhere('link', 'like', '%' . $key . '%')->paginate(10);
        // dd($key);
        if ($request->ajax()) {
            $view = view('admin.account.list-search-account',compact('list_account'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
