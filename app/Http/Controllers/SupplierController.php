<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;

class SupplierController extends Controller
{
    // Start Supplier All Method
    public function AllSupplier(){
        $suppliers = Supplier::all();
        return view('pages.supplier.supplier_all',compact('suppliers'));
    }
    // End Supplier All Method

    // Start Supplier Add Method
    public function AddSupplier(){
        return view('pages.supplier.supplier_add');
    }
    // End Supplier Add Method


    // Start Supplier Store Method
    public function StoreSupplier(Request $request){
        $count_supplier= Supplier::count();
        if($count_supplier>0){
            $latest_supplier= Supplier::latest()->first()->id;
            $supplier_id = 'SP'.str_pad($latest_supplier+1,6,0,STR_PAD_LEFT);
        }else{
            $supplier_id = 'SP'.str_pad(0+1,6,0,STR_PAD_LEFT);
        }

        Supplier::insert([
            'supplier_id'=>$supplier_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'created_at'=> Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Supplier Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.supplier')->with($notification);
    }
    //End Supplier Store Method

    // Start Supplier Edit Method
    public function EditSupplier($id){
        $supplier = Supplier::findOrFail($id);
        return view('pages.supplier.supplier_edit',compact('supplier'));
    }
    //End Supplier Edit Method

    // Start Supplier Update Method
    public function UpdateSupplier(Request $request,$id){
        Supplier::findOrFail($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'updated_at'=> Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Supplier Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.supplier')->with($notification);
    }
    //End Supplier Update Method

    // Start Supplier Delete Method
    public function DeleteSupplier($id){
        $supplier=Supplier::findOrFail($id);
        @unlink($supplier->image);
        $supplier->delete();
        $notification = array(
            'message' => 'Supplier Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //End Supplier Delete Method


}
