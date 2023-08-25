<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;
class CustomerController extends Controller
{
    // Start Customer All Method
    public function AllCustomer(){
        $customers = Customer::all();
        return view('pages.customer.customer_all',compact('customers'));
    }
    // End Customer All Method

    // Start Customer Add Method
    public function AddCustomer(){
        return view('pages.customer.customer_add');
    }
    // End Customer Add Method


    // Start Customer Store Method
    public function StoreCustomer(Request $request){
        $count_customer= Customer::count();
        if($count_customer>0){
            $latest_customer= Customer::latest()->first()->id;
            $customer_id = 'CU'.str_pad($latest_customer+1,6,0,STR_PAD_LEFT);
        }else{
            $customer_id = 'CU'.str_pad(0+1,6,0,STR_PAD_LEFT);
        }

        Customer::insert([
            'customer_id'=>$customer_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'created_at'=> Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Customer Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.customer')->with($notification);
    }
    //End Customer Store Method

    // Start Customer Edit Method
    public function Editcustomer($id){
        $customer = Customer::findOrFail($id);
        return view('pages.customer.customer_edit',compact('customer'));
    }
    //End Customer Edit Method

    // Start Customer Update Method
    public function UpdateCustomer(Request $request,$id){
        Customer::findOrFail($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'updated_at'=> Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Customer Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.customer')->with($notification);
    }
    //End Customer Update Method

    // Start Customer Delete Method
    public function DeleteCustomer($id){
        $customer=Customer::findOrFail($id);
        @unlink($customer->image);
        $customer->delete();
        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //End Customer Delete Method

}
