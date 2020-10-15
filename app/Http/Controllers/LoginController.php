<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\InforWeb;
use Hash;
use DB;
use Session;
use Cookie;
use Carbon\Carbon;
use Illuminate\Http\Response;
use App\TemplateLoginSetting;
use App\Jobs\EmailSettingAccount;

class LoginController extends Controller
{

    public function getLogin(Request $request){
        if (Auth::user()) {
            if(Auth::user()->quyen == 0){
                return redirect('admin_slug/');
            }else{
                return redirect()->route('home');
            }
        }else{
            $style_login = TemplateLoginSetting::where('status',1)->pluck('file')->first();
            return view('login',['style_login' => $style_login]);
        };
    }
    public function postLogin(Request $request){
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required|min:6|max:32',
                // 'remember_me' => 'boolean'
            ],
            [
                'email.required' => 'Bạn chưa nhập Địa chỉ Email!',
                'password.required' => 'Bạn chưa nhập Mật khẩu!',
                'password.min' => 'Mật Khẩu gồm tối thiểu 6 ký tự!',
                'password.max' => 'Mật Khẩu gồm tối đa 32 ký tự!'
            ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password, 
            'parent_verifi_email' => 1
        ])){
            return redirect()->route('login_admin');
        }
        elseif (Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password, 
            'parent_verifi_email' => 0
        ])){
            Auth::logout();
            return redirect(route('login_admin'))->with('message',"Tài khoản chưa được xác thực, vui lòng kiểm tra gmail hoặc xác thực lại!");
        }
        else{
            return redirect(route('login_admin'))->with('message',"Tài khoản hoặc mật khảu không đúng, vui lòng kiểm tra lại!");
        };
            
    }

    public function getLoginOAuth(){
        dd("Login");
    }

    public function postSignUp(Request $request)
    {
        // dd("register");
        $this->validate($request,
            [
                'email' => 'required|email|min:8|max:32|unique:users',
                'firstname' => 'required|min:2|max:12',
                'lastname' => 'required|min:2|max:12',
                'password' => 'required|min:6|max:32|confirmed',
                // 'g-recaptcha-response' => ['required', new App\Rules\ValidRecaptcha]
            ],
            [
                'email.required' => 'Bạn chưa nhập Địa chỉ Email!',
                'email.unique' => 'Email đã được đăng kí!',
                'email.email' => 'Bạn vui lòng nhập đúng định dạng Email(abc@gmail.com)!',
                'firstname.min' => 'Email của bạn quá ngắn(Vui lòng nhập đúng email của bạn để xác thực sau này)!',
                'firstname.max' => 'Email của bạn quá dài(Vui lòng nhập đúng email của bạn để xác thực sau này)!',
                'firstname.required' => 'Bạn chưa nhập FirstName!',
                'firstname.min' => 'Họ của bạn quá ngắn(tối thiểu 2 chữ và tối đa 12 chữ)!',
                'firstname.max' => 'Họ của bạn quá dài(tối thiểu 2 chữ và tối đa 12 chữ)!',
                'lastname.required' => 'Bạn chưa nhập LastName!',
                'lastname.min' => 'Tên của bạn quá ngắn(tối thiểu 2 chữ và tối đa 12 chữ)!',
                'lastname.max' => 'Tên của bạn quá dài(tối thiểu 2 chữ và tối đa 12 chữ)!',
                'password.required' => 'Bạn chưa nhập Mật khẩu!',
                'password.comfirmed' => 'Mật khẩu xác nhận không trùng khớp!',
                'password.min' => 'Mật Khẩu gồm tối thiểu 6 ký tự!',
                'password.max' => 'Mật Khẩu gồm tối đa 32 ký tự!'
            ]);
        $noichuoi = $request->firstname . " " . $request->lastname;
        $confirmation_code = time().uniqid(true);
        $infor_web = InforWeb::orderBy('id','DESC')->first();
        EmailSettingAccount::dispatch($noichuoi,$infor_web->linkweb,$infor_web->address,$infor_web->name,$request->email,$confirmation_code,"mail.formsend",$noichuoi,"Thông báo xác nhận tài khoản!",'');

        $adduser = new User;
        $adduser->firstname = $request->firstname;
        $adduser->lastname = $request->lastname;
        $adduser->name = $noichuoi;
        $adduser->quyen = 3;
        $adduser->parent_verifi_email = 0;
        $adduser->email = $request->email;
        $adduser->avatar = "default.png";
        $adduser->password = bcrypt($request->password);
        $adduser->confirmation_code = $confirmation_code;
        // $adduser->confirmed = 0;
        $adduser->save();
        $id_user = DB::table('users')->orderBy('id', 'DESC')->first();
        // send mail
        // dd($request);
        
        return redirect(route('login_admin'))->with('message', 'Tạo tài khoản thành công, vui lòng kiểm tra email và xác nhận!');
    }
    public function Verify($email,$confirmation_code)
    {
        // dd($email);
        $confi_db = DB::table('users')->where('email',$email)->first();
        if (!empty($confi_db)) {
            if ($confi_db->parent_verifi_email == 1) {
                return redirect(route('login_admin'))->with('error','Tài khoản của bạn đã được xác thực từ trước!');
            }else{
                if ($confi_db->confirmation_code == $confirmation_code ) {
                   $updateuser = User::find($confi_db->id);
                   $updateuser->parent_verifi_email = 1;
                   $updateuser->save();
                   $infor_web = InforWeb::orderBy('id','DESC')->first();

                return redirect(route('login_admin'))->with('message','Bạn đã xác thực tài khoản thành công! Đăng nhập để nhận được hỗ trợ tốt nhất!');
                }else{
                    return redirect(route('login_admin'))->with('error','Yêu cầu xác thực không thành công, vui lòng kiểm tra lại!');
                }
            }
        }
        else
        {
            return redirect(route('login_admin'))->with('error','Yêu cầu xác thực không thành công, vui lòng kiểm tra lại!');
        }
        
    }  
    public function getRemember()
    {
        return view('page.login.remember');
    }
    public function postRemember(Request $request)
    {
        $user_db = DB::table('users')->where('email',$request->email)->first();
        // nếu tồn tại email
        if (!empty($user_db)) {
            // nếu tài khoản đã xác thực
            if ($user_db->parent_verifi_email == 1) 
            {
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                // generate a pin based on 2 * 7 digits + a random character
                $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                    . $characters[rand(0, strlen($characters) - 1)];
                // shuffle the result
                $string = str_shuffle($pin);
                $time = time().uniqid(true);
                // dd($time);
                $new_confi_code_ramdom = $user_db->confirmation_code . 
                (
                    "Time:" 

                    . time()

                    . "String:"

                    . ($string) 

                    . "RefogePassWord|"
                );
                $new_confirmation_code = User::find($user_db->id);
                $new_confirmation_code->confirmation_code = $new_confi_code_ramdom;
                $new_confirmation_code->save();
                $infor_web = InforWeb::orderBy('id','DESC')->first();

                EmailSettingAccount::dispatch($user_db->name,$infor_web->linkweb,$infor_web->address,$infor_web->name,$request->email,$new_confi_code_ramdom,"mail.resetpassword",$infor_web->name,"Thông báo xác nhận tài khoản!",'');
                return redirect(route('login_admin'))->with('message','Gmail xác nhận reset password của tài khoản đã được gửi đến gmail của bạn!');
            }else
            // nếu chưa xác thực
            {
                return redirect(route('login_admin'))->with('error','Tài khoản của bạn chưa đc xác thực trước đó, vui lòng kiểm tra email!. Nếu cần giúp đỡ, vui lòng liên hệ với chúng tôi qua phần liên hệ!');
            }
            // end kiểm tra xác thực
        }
        // nếu không tồn tại email
        else
        {
            return redirect(route('login_admin'))->with('error','Email này không thuộc tài khoản nào!');
        }
        // end kiểm tra email ton tai hay ko
    }
    public function sendResetPassword(Request $request)
    {
        $user_db = DB::table('users')->where('email',$request->email)->first();
        // nếu tồn tại email
        if (!empty($user_db)) {
            // nếu tài khoản đã xác thực
            if ($user_db->parent_verifi_email == 1) 
            {
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                // generate a pin based on 2 * 7 digits + a random character
                $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                    . $characters[rand(0, strlen($characters) - 1)];
                // shuffle the result
                $string = str_shuffle($pin);
                $time = time().uniqid(true);
                // dd($time);
                $new_confi_code_ramdom = $user_db->confirmation_code . 
                (
                    "Time:" 

                    . time()

                    . "String:"

                    . ($string) 

                    . "RefogePassWord|"
                );
                $new_confirmation_code = User::find($user_db->id);
                $new_confirmation_code->confirmation_code = $new_confi_code_ramdom;
                $new_confirmation_code->save();
                $infor_web = InforWeb::orderBy('id','DESC')->first();
                EmailSettingAccount::dispatch($user_db->name,$infor_web->linkweb,$infor_web->address,$infor_web->name,$request->email,$new_confi_code_ramdom,"mail.resetpassword",$infor_web->name,"Thông báo xác nhận tài khoản!",'');
                    return redirect(route('login_admin'))->with('error','Yêu cầu đăt lại mật khẩu đã được gửi đến gmail đăng kí của bạn!');
            }else
            // nếu chưa xác thực
            {
                return "Fail";
            }
            // end kiểm tra xác thực
        }
        // nếu không tồn tại email
        else
        {
            return redirect(route('login_admin'))->with('error','Email này không thuộc tài khoản nào!');
        }
    }
    public function resetPassword($email,$confirmation_code)
    {
        $confi_db = DB::table('users')->where('email',$email)->first();
        if (!empty($confi_db)) {
            if ($confi_db->parent_verifi_email == 1) {
                if ($confi_db->confirmation_code == $confirmation_code ) {
                    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                    . $characters[rand(0, strlen($characters) - 1)];
                    // shuffle the result
                    $string = str_shuffle($pin);
                   $initramdom = $string;
                   $updateuser = User::find($confi_db->id);
                   $updateuser->password = bcrypt($initramdom);
                   $updateuser->save();
                   $infor_web = InforWeb::orderBy('id','DESC')->first();
                   EmailSettingAccount::dispatch($confi_db->name,$infor_web->linkweb,$infor_web->address,$infor_web->name,$email,$confirmation_code,"mail.sendpasswordreset",$infor_web->name,"Mật khẩu mới đã được gửi tới Gmail của bạn!",$initramdom);
                return redirect(route('login_admin'))->with('message','Mật khẩu của bạn đã được reset thành công!');
                }else{
                    return redirect(route('login_admin'))->with('error','Yêu cầu không xác thực, vui lòng kiểm tra lại!');
                }
            }else{
                return redirect(route('login_admin'))->with('error','Tài khoản chưa được xác thực email, vui lòng kiểm tra lại!');
            }
        }
        else
        {
            return redirect(route('login_admin'))->with('error','Yêu cầu không xác thực, vui lòng kiểm tra lại!');
        }
    }
    //route reforge password new
    public function getReforgePassword()
    {
        return view('page.login.reforgepass');
    }

    public function postReforgePassword(Request $request)
    {
        $this->validate($request,
            [
                'password' => 'required|min:6|max:32|confirmed',
                'oldpassword' => 'required'
            ],
            [
                'password.required' => 'Bạn chưa nhập Mật khẩu moi!',
                'password.required' => 'Bạn chưa nhập Mật khẩu cu!',
                'password.confirmed' => 'Mật khẩu xác nhận không trùng khớp!',
                'password.min' => 'Mật Khẩu gồm tối thiểu 6 ký tự!',
                'password.max' => 'Mật Khẩu gồm tối đa 32 ký tự!'
            ]);
        // dd(bcrypt($request->oldpassword));
        $id_user = Auth::user()->id;
        if(Auth::attempt(['email' => Auth::user()->email, 'password' => $request->oldpassword])){
            $updatepassword = User::find(Auth::user()->id);
            $updatepassword->password = bcrypt($request->password);
            $updatepassword->save();
            $user = User::where('id',$id_user)->first();
            Auth::attempt(['email' => $user->email, 'password' => $user->password]);
            return redirect('reforgepass')->with('doi mat khau thanh cong!');
        }else{
            
        }
        // dd($request);
    }    

    public function Logout(Request $request){
        // dd($request);
        Auth::logout();
        return redirect('login');
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
