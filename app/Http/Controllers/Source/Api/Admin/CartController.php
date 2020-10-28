<?php

namespace App\Http\Controllers\Source\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Bill;

class CartController extends Controller
{
    public function postUpdateBillStatusCart(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
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
            $id = $request->id;
            try {
                $update_post = Bill::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return redirect(route('admin.notfound'));
            }
            $status = (int)$request->status;
            if ($status == 0) {
                // đã hoàn thành
                $update_post->status = 0;
            }elseif($status == 1){
                // chưa sửa lý
                $update_post->status = 1;
            }elseif ($status == 2) {
                // đang giao hàng
                $update_post->status = 2;
            }else{
                // danger
                return ['message' => 'fail'];
            };
            $update_post->update();
            return ['message' => 'success'];
        }
    }
}
