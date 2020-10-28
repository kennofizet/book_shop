<?php

namespace App\Http\Controllers\Source\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\InforWeb;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function postUpdateMyAccount(Request $request)
    {
        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        $my_account = User::find(Auth::user()->id);
        if (!empty($name)) {
            $my_account->name = $name;
        }
        if (!empty($phone)) {
            $my_account->phone = (string)$phone;
        }
        if (!empty($address)) {
            $my_account->address = $address;
        }
        if (!empty($name) or !empty($phone) or !empty($address)) {
            $my_account->update();
        }
        return ['message' => "success"];
    }
    public function postChangePasswordMyAccount(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:6|confirmed'
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

            request()->user()->fill([
                'password' => Hash::make(request()->input('new_password'))
            ])->save();

            return ['message' => "success"];
        }
    }
    public function postLockAccount(Request $request)
    {
        // dd($request);
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
            $id_admin = InforWeb::first()->User->id;
            if ($id_admin == $id) {
                return ['message' => "admin"];
            }else{

                try {
                    $lock_account = User::findOrFail($id);
                } catch (ModelNotFoundException $ex) {
                    return redirect(route('admin.notfound'));
                }
                $lock_account->lock_check = 1;
                $lock_account->update();
                return ['message' => "success"];
            }
        }
    }
    public function postUnLockAccount(Request $request)
    {
        // dd($request);
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
            $id_admin = InforWeb::first()->User->id;
            if ($id_admin == $id) {
                return ['message' => "success"];
            }else{

                try {
                    $lock_account = User::findOrFail($id);
                } catch (ModelNotFoundException $ex) {
                    return redirect(route('admin.notfound'));
                }
                $lock_account->lock_check = 0;
                $lock_account->update();
                return ['message' => "success"];
            }
        }
    }
    public function postDeleteAccount(Request $request)
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
            $id_admin = InforWeb::first()->User->id;
            if ($id_admin == $id) {
                return ['message' => "admin"];
            }else{

                try {
                    $delete_account = User::findOrFail($id);
                } catch (ModelNotFoundException $ex) {
                    return redirect(route('admin.notfound'));
                }
                $delete_account->delete();
                return ['message' => "success"];
            }
        }
    }
}
