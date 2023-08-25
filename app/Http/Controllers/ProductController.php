<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{

    // Start Product All Method
    public function AllProduct(){
        $products = Product::orderBy('id','DESC')->get();
        return view('pages.product.product_all',compact('products'));
    }
    // End Product All Method

    // Start Product Add Method
    public function AddProduct(){
        return view('pages.product.product_add');
    }
    // End Product Add Method

    // Start Product Store Method
    public function StoreProduct(Request $request){
        $image = $request->file('pr_image');
        $name_gen = hexdec(uniqid()).'_product.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120,120)->save('uploads/products/'.$name_gen);
        $save_url = 'uploads/products/'.$name_gen;
        if (empty($request->stock)) {
            $stock=0;
        }else{
            $stock=$request->stock;
        }
        Product::insert([
            'pr_name'=>$request->pr_name,
            'pr_code'=>$request->pr_code,
            'stock'=>$stock,
            'currency'=>$request->currency,
            'price'=>$request->price,
            'x_margin'=>$request->x_margin,
            'selling_price'=>$request->selling_price,
            'pr_image'=>$save_url,
            'notes'=>$request->notes,
            'created_at'=> Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
    }
    // End Product Store Method

    // Start Product Edit Method
    public function EditProduct($id){
        $product = Product::findOrFail($id);
        return view('pages.product.product_edit',compact('product'));
    }
    // End Product Edit Method


    // Update Product
    public function UpdateProduct(Request $request,$id){
        $image = $request->file('pr_image');
        if (empty($request->stock)) {
            $stock=0;
        }else{
            $stock=$request->stock;
        }


        if($image){
            @unlink(Product::findOrFail($id)->pr_image);
            $name_gen = hexdec(uniqid()).'_product.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(120,120)->save('uploads/products/'.$name_gen);
            $save_url = 'uploads/products/'.$name_gen;
            Product::findOrFail($id)->update([
                'pr_name'=>$request->pr_name,
                'pr_code'=>$request->pr_code,
                'stock'=>$stock,
                'currency'=>$request->currency,
                'price'=>$request->price,
                'x_margin'=>$request->x_margin,
                'selling_price'=>$request->selling_price,
                'pr_image'=>$save_url,
                'notes'=>$request->notes,
                'updated_at'=> Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Product Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.product')->with($notification);
        }else{
            Product::findOrFail($id)->update([
                'pr_name'=>$request->pr_name,
                'pr_code'=>$request->pr_code,
                'stock'=>$stock,
                'currency'=>$request->currency,
                'price'=>$request->price,
                'x_margin'=>$request->x_margin,
                'selling_price'=>$request->selling_price,
                'notes'=>$request->notes,
                'updated_at'=> Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Product Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.product')->with($notification);
        }
    }
    // Update Product end


    // Delete Product end
    public function DeleteProduct($id){
        $product=Product::findOrFail($id);
        @unlink($product->pr_image);
        $product->delete();
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // Delete Product end


}
