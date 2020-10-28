<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bill;
use App\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartController extends Controller
{
    public function getCartList()
    {
    	$list_bill = Bill::orderBy('id','DESC')->paginate(10);
    	$count_bill = Bill::all()->count();
    	$count_bill_active = Bill::where('status',1)->count();
        $count_bill_transport = Bill::where('status',2)->count();
    	$count_bill_done = Bill::where('status',0)->count();
        return view('admin.cart.list',[
        	'count_bill' => $count_bill,
        	'count_bill_active' => $count_bill_active,
            'count_bill_transport' => $count_bill_transport,
        	'count_bill_done' => $count_bill_done,
        	'list_bill' => $list_bill
        ]);
    }
    public function getCartListDetail($id)
    {
    	try {
            $bill_detail = Bill::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return redirect(route('admin.notfound'));
        }
        return view('admin.cart.list-detail',[
        	'bill_detail' => $bill_detail
        ]);
    }
    public function getCartListCustomer()
    {
        $count_customer = Customer::all()->count();
    	$list_customer = Customer::orderBy('id','DESC')->paginate(10);
        return view('admin.cart.list-customer',[
        	'count_customer' => $count_customer,
            'list_customer' => $list_customer
        ]);
    }
    public function getCartCustomerById($id)
    {
        $count_customer = Customer::all()->count();
    	try {
            $list_customer = Customer::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return redirect(route('admin.notfound'));
        }
        $list_customer_new = Customer::where('id',$id)->paginate(10);
        return view('admin.cart.list-customer',[
            'count_customer' => $count_customer,
        	'list_customer' => $list_customer_new
        ]);
    }
    public function postSearchCartCustomer(Request $request)
    {
        $key = $request->key;
        $list_customer = Customer::orderBy('id','DESC')->where('name', 'like', '%' . $key . '%')->orWhere('email', 'like', '%' . $key . '%')->orWhere('address', 'like', '%' . $key . '%')->orWhere('phone', 'like', '%' . $key . '%')->orWhere('note', 'like', '%' . $key . '%')->paginate(10);
        // dd($key);
        if ($request->ajax()) {
            $view = view('admin.cart.list-search-customer',compact('list_customer'))->render();
            return response()->json(['html'=>$view]);
        }
    }
    public function postSearchCart(Request $request)
    {
        $key = $request->key;
        $list_bill = Bill::orderBy('id','DESC')->where('total', 'like', '%' . $key . '%')->orWhere('date', 'like', '%' . $key . '%')->orWhere('code', 'like', '%' . $key . '%')->orWhere('note', 'like', '%' . $key . '%')->paginate(10);
        if ($request->ajax()) {
            $view = view('admin.cart.list-search',compact('list_bill'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
