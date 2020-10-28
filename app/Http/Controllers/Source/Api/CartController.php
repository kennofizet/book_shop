<?php

namespace App\Http\Controllers\Source\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use Validator;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartController extends Controller
{
    public function postUpdateToCartSingle(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'number' => 'required|numeric',
            'id' => 'required',
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
            $number = $request->number;
            $qty = $request->number;
            if ($qty < 1) {
                $oldCart = Session::has('cart')?Session::get('cart'):null;
                $cart = new Cart($oldCart);
                $cart->removeItem($id);
                if(count($cart->items)>0){
                    Session::put('cart',$cart);
                }
                else{
                    Session::forget('cart');
                }
                return ['message' => "qty"];
            };
            try {
                $product = Product::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return ['message' => "fail"];
            };
            $cart = Session::get('cart');
            $cart_list = $cart->items;
            if(array_key_exists($id, $cart_list)){
                $oldCart = Session('cart')?Session::get('cart'):null;
                $cart = new Cart($oldCart);
                $cart->updateSingle($id, $qty);
                $request->session()->put('cart',$cart);
                return ['message' => "success"];
            }else{
                return ['message' => "fail"];
            };
        }
    }
    public function postAddtoCart(Request $request){
        $id = $request->id;
        try {
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return ['message' => "fail"];
        }
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart',$cart);
        return ['message' => "success"];
    }
    public function postAddtoCartMulti(Request $request){
        $validator  = Validator::make($request->all(), [
            'qty' => 'required|numeric',
            'id' => 'required',
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
            $qty = $request->qty;
            if ($qty < 1) {
                return ['message' => "qty"];
            }
            try {
                $product = Product::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return ['message' => "fail"];
            }
            $oldCart = Session('cart')?Session::get('cart'):null;
            $cart = new Cart($oldCart);
            $cart->addMulti($product, $id, $qty);
            $request->session()->put('cart',$cart);
            return ['message' => "success"];
        }
    }

    public function postDeleteCartItem(Request $request){
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
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
            $cart = Session::get('cart');
            $cart_list = $cart->items;
            if(array_key_exists($id, $cart_list)){
                $oldCart = Session::has('cart')?Session::get('cart'):null;
                $cart_end = new Cart($oldCart);
                $cart_end->removeItem($id);
                if(count($cart_end->items)>0){
                    Session::put('cart',$cart_end);
                }
                else{
                    Session::forget('cart');
                }
                return ['message' => "success"];
            }else{
                return ['message' => "fail"];
            };

            
            return redirect()->back();
        }
    }
    public function postCartCheckOut(Request $request){
        $validator  = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
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
            if ($check_payment = $request->payment_method == "direct-payment") {$payment_hasd = 1;}elseif ($request->payment_method == "payment-home") {$payment_hasd = 2;}else{
                return ["message" => "payment"];
            };
            $cart = Session::get('cart');
            if (!empty($cart)) {
                $customer = new Customer;
                $customer->name = $request->name;
                $customer->gender = "";
                $customer->email = $request->email;
                $customer->address = $request->address;
                $customer->phone = $request->phone;
                $customer->note = $request->notes;
                $customer->save();

                $bill = new Bill;
                $bill->id_customer = $customer->id;
                $bill->date = Carbon::now();
                $bill->total = $cart->totalPrice;
                $bill->payment = $payment_hasd;
                $bill->status = 1;
                $bill->code = Str::random(12).$customer->id;
                $bill->note = $request->notes;
                $bill->save();

                foreach ($cart->items as $key => $value) {
                    $bill_detail = new BillDetail;
                    $bill_detail->id_bill = $bill->id;
                    $bill_detail->id_product = $key;
                    $bill_detail->quantity = $value['qty'];
                    $bill_detail->unit_price = ($value['price']/$value['qty']);
                    $bill_detail->save();

                    $update_totle_cart_product = Product::find($value['item']->id);
                    if (!empty($update_totle_cart_product)) {
                        $update_totle_cart_product->total_cart = $update_totle_cart_product->total_cart + $value['qty'];
                        $update_totle_cart_product->update();
                    }else{

                    }
                }
                Session::forget('cart');
                return ["message" => "success"];
            }else{
                return ["message" => "null"];
            }
        }
    }
    public function postCountItemCart()
    {
        $cart = Session::get('cart');
        if (!empty($cart)) {
            $count_item = $cart->totalQty;
        }else{
            $count_item = 0;
        }
        return ['count_item' => $count_item];
    }
}
