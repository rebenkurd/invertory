<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Invertory;
use App\Models\ProductItem;
use Carbon\Carbon;
use Illuminate\Http\Response;

class SaleController extends Controller
{
    // Start sale All Method
    public function AllSale(){
        $sales = Sale::latest()->get();
        return view('pages.sale.sale_all',compact('sales'));
    }
    // End sale All Method


    // Start sale Add Method
    public function AddSale(){
        $products = Product::orderBy('pr_name','ASC')->get();
        $customers = Customer::orderBy('name','ASC')->get();
        return view('pages.sale.sale_add',compact('products','customers'));
    }
    // End sale Add Method

    // Start sale Ajax Product Item
    public function AjaxProductItem($id){
        $data = Product::where('id',$id)->first();
        return response()->json($data);
    }
    // End sale Ajax Product Item

    // Start sale Store Item
    public function StoreSale(Request $request){


        if($request->pay_amount>0){
            $pay_due = $request->amount - $request->pay_amount;
            if($pay_due == $request->amount){
                $pay_status='unpaid';
            }elseif($pay_due > 0 && $pay_due < $request->amount){
                $pay_status='partial';
            }elseif($pay_due == 0){
                $pay_status='paid';
            }
        }elseif($request->pay_amount > $request->amount){
            $pay_due = $request->amount;
            $pay_status='paid';
        }else{
            $pay_due = $request->amount;
            $pay_status='unpaid';
        }

        $customer_debit=Customer::findOrFail($request->customer_id)->debit;

        $debit = $customer_debit+$pay_due;
        Customer::findOrFail($request->customer_id)->update([
            'debit'=>$debit,
            'updated_at'=>Carbon::now()
        ]);

        $invertory_id = Invertory::first()->id;

        if ($request->file('attach_file')) {
            $count_sale= Sale::count();
            if($count_sale>0){
                $latest_sale= Sale::latest()->first()->id;
                $invoiceno_gen = 'SL'.str_pad($latest_sale+1,6,0,STR_PAD_LEFT);
            }else{
                $invoiceno_gen = 'SL'.str_pad(0+1,6,0,STR_PAD_LEFT);
            }
        $file = $request->file('attach_file');
        $name_gen = hexdec(uniqid()).'_invoice.'.$file->getClientOriginalExtension();
        $file->move('uploads/invoices/',$name_gen);
        $save_url = 'uploads/invoices/'.$name_gen;



        if(!$request->invoice_no){
            $sale_id=Sale::insertGetId([
                'customer_id'=>$request->customer_id,
                'invoice_no'=>$invoiceno_gen,
                'sale_date'=>$request->sale_date,
                'currency'=>$request->currency,
                'invertory_id'=>$invertory_id,
                'attach_file'=>$save_url,
                'amount'=>$request->amount,
                'pay_status'=>$pay_status,
                'pay_due'=>$pay_due,
                'notes'=>$request->notes,
                'created_at'=>Carbon::now()
            ]);
        }else{
            $sale_id=Sale::insertGetId([
                'customer_id'=>$request->customer_id,
                'invoice_no'=>$request->invoice_no,
                'sale_date'=>$request->sale_date,
                'currency'=>$request->currency,
                'invertory_id'=>$invertory_id,
                'attach_file'=>$save_url,
                'amount'=>$request->amount,
                'pay_status'=>$pay_status,
                'pay_due'=>$pay_due,
                'notes'=>$request->notes,
                'created_at'=>Carbon::now()
            ]);
        }

        $items = $request->pr_id;
        foreach($items as $key => $item){
            $product=Product::findOrFail($item);
            ProductItem::insert([
                'product_id'=>$product->id,
                'sale_id'=>$sale_id,
                'amount'=>$request->total_amount[$key] ,
                'quantity'=>$request->pr_qty[$key],
                'created_at'=>Carbon::now()
            ]);
        }

        foreach($items as $key => $item){
            $qty=Product::findOrFail($item)->qty - $request->pr_qty[$key];
            Product::findOrFail($item)->update([
                'qty'=> $qty ,
                'updated_at'=>Carbon::now()
            ]);
        }

        if($request->pay_amount>0){
            $payment_id=Payment::insert([
                'sale_id'=>$sale_id,
                'pay_amount'=>$request->pay_amount,
                'pay_date'=>Carbon::now(),
                'pay_type'=>$request->pay_type,
                'pay_note'=>$request->pay_note,
                'created_at'=>Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'sale Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.sale')->with($notification);

        }else{
            $count_sale= Sale::count();
            if($count_sale>0){
                $latest_sale= Sale::latest()->first()->id;
                $invoiceno_gen = 'SL'.str_pad($latest_sale+1,6,0,STR_PAD_LEFT);
            }else{
                $invoiceno_gen = 'SL'.str_pad(0+1,6,0,STR_PAD_LEFT);

            }

            if(!$request->invoice_no){
                $sale_id=Sale::insertGetId([
                    'customer_id'=>$request->customer_id,
                    'invoice_no'=>$invoiceno_gen,
                    'sale_date'=>$request->sale_date,
                    'currency'=>$request->currency,
                    'invertory_id'=>$invertory_id,
                    'amount'=>$request->amount,
                    'pay_status'=>$pay_status,
                    'pay_due'=>$pay_due,
                    'notes'=>$request->notes,
                    'created_at'=>Carbon::now()
                ]);
            }else{
                $sale_id=Sale::insertGetId([
                    'customer_id'=>$request->customer_id,
                    'invoice_no'=>$request->invoice_no,
                    'sale_date'=>$request->sale_date,
                    'currency'=>$request->currency,
                    'invertory_id'=>$invertory_id,
                    'amount'=>$request->amount,
                    'pay_status'=>$pay_status,
                    'pay_due'=>$pay_due,
                    'notes'=>$request->notes,
                    'created_at'=>Carbon::now()
                ]);
            }

            $items = $request->pr_id;
            foreach($items as $key => $item){
                $product=Product::findOrFail($item);
                ProductItem::insert([
                    'product_id'=>$product->id,
                    'sale_id'=>$sale_id,
                    'amount'=>$request->total_amount[$key] ,
                    'quantity'=>$request->pr_qty[$key],
                    'created_at'=>Carbon::now()
                ]);
                $qty=Product::findOrFail($item)->qty - $request->pr_qty[$key];
                Product::findOrFail($item)->update([
                    'qty'=> $qty ,
                    'updated_at'=>Carbon::now()
                ]);
            }

            if($request->pay_amount>0){
                $payment_id=Payment::insert([
                    'sale_id'=>$sale_id,
                    'pay_amount'=>$request->pay_amount,
                    'pay_date'=>Carbon::now(),
                    'pay_type'=>$request->pay_type,
                    'pay_note'=>$request->pay_note,
                    'created_at'=>Carbon::now(),
                ]);
            }


            $notification = array(
                'message' => 'sale Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.sale')->with($notification);
        }


    }
    // End sale Store Item

    // Start sale Edit Method
    public function EditSale($id){
        $products = Product::orderBy('pr_name','ASC')->get();
        $sale = Sale::findOrFail($id);
        $items = ProductItem::where('sale_id',$id)->get();
        $payments = Payment::where('sale_id',$id)->get();
        $customers = Customer::orderBy('name','ASC')->get();
        return view('pages.sale.sale_edit',compact('sale','products','items','customers','payments'));
    }
    // End sale Edit Method

    // Start sale Details Method
    public function DetailsSale($id){
        $products = Product::orderBy('pr_name','ASC')->get();
        $sale = Sale::findOrFail($id);
        $items = ProductItem::where('sale_id',$id)->get();
        $payments = Payment::where('sale_id',$id)->get();
        $customers = Customer::orderBy('name','ASC')->get();
        return view('pages.sale.sale_details',compact('sale','products','items','customers','payments'));
    }
    // End sale Details Method


    // Start sale Update Item
    public function UpdateSale(Request $request, $id){

        $sale=Sale::findOrFail($id);
        if($request->pay_amount > 0 && $request->pay_amount <= $sale->pay_due){
            $pay_due =  $sale->pay_due-$request->pay_amount;

            if ($pay_due >0) {
                $pay_status = 'partial';
            }else if($pay_due == 0) {
                $pay_status = 'paid';
            }

            $customer=Customer::findOrFail($request->customer_id);
            $debit = $customer->debit - $request->pay_amount;
            $old_debit = $customer->old_debit + $request->pay_amount;
            Customer::findOrFail($request->customer_id)->update([
                'debit'=>$debit,
                'old_debit'=>$old_debit,
                'updated_at'=>Carbon::now()
            ]);

        }else if($request->pay_amount > $sale->pay_due ){
            $notification = array(
                'message' => 'Your Amount Greater than Your Due',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $pay_status = $sale->pay_status;
            $pay_due=$sale->pay_due;
        }


        if ($request->file('attach_file')) {
            @unlink($request->file('exist_attach_file'));
            $file = $request->file('attach_file');
            $name_gen = hexdec(uniqid()).'_invoice.'.$file->getClientOriginalExtension();
            $file->move('uploads/invoices/',$name_gen);
            $save_url = 'uploads/invoices/'.$name_gen;


            // Update the sale record
            Sale::findOrFail($id)->update([
                'customer_id' => $request->customer_id,
                'sale_date' => $request->sale_date,
                'currency' => $request->currency,
                'amount' => $request->amount,
                'attach_file' => $save_url,
                'pay_status'=>$pay_status,
                'pay_due'=>$pay_due,
                'notes' => $request->notes,
                'updated_at' => Carbon::now()
            ]);

            $items = $request->pr_id;
            foreach ($items as $key => $item) {
                $product = Product::find($item);
                $sale_id = $id;
                $existingProductItem = ProductItem::where('product_id', $item)->first();
                if ($existingProductItem) {
                    // Update the existing product item
                    $existingProductItem->update([
                        'amount' => $request->total_amount[$key],
                        'quantity' => $request->pr_qty[$key],
                        'updated_at' => Carbon::now()
                    ]);
                } else {
                    // Insert a new product item
                    ProductItem::insert([
                        'product_id' => $item,
                        'sale_id' => $sale_id,
                        'amount' => $request->total_amount[$key],
                        'quantity' => $request->pr_qty[$key],
                        'created_at' => Carbon::now()
                    ]);
                }

                // Update the product quantity
                $qty = $product->qty - $request->pr_qty[$key];
                $product->update([
                    'qty' => $qty,
                    'updated_at' => Carbon::now()
                ]);
            }

            if($request->pay_amount>0){
                $payment_id=Payment::insert([
                    'sale_id'=>$sale_id,
                    'pay_amount'=>$request->pay_amount,
                    'pay_date'=>Carbon::now(),
                    'pay_type'=>$request->pay_type,
                    'pay_note'=>$request->pay_note,
                    'created_at'=>Carbon::now(),
                ]);
            }
            $notification = array(
                'message' => 'sale Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.sale')->with($notification);

         }
        else{

            // Update the sale record
            Sale::findOrFail($id)->update([
                'customer_id' => $request->customer_id,
                'sale_date' => $request->sale_date,
                'currency' => $request->currency,
                'amount' => $request->amount,
                'notes' => $request->notes,
                'pay_status'=>$pay_status,
                'pay_due'=>$pay_due,
                'updated_at' => Carbon::now()
            ]);

            $items = $request->pr_id;
            foreach ($items as $key => $item) {
                $product = Product::find($item);
                $sale_id = $id;
                $existingProductItem = ProductItem::where('product_id', $item)->first();
                if ($existingProductItem) {
                    // Update the existing product item
                    $existingProductItem->update([
                        'amount' => $request->total_amount[$key],
                        'quantity' => $request->pr_qty[$key],
                        'updated_at' => Carbon::now()
                    ]);
                } else {
                    // Insert a new product item
                    ProductItem::insert([
                        'product_id' => $item,
                        'sale_id' => $sale_id,
                        'amount' => $request->total_amount[$key],
                        'quantity' => $request->pr_qty[$key],
                        'created_at' => Carbon::now()
                    ]);
                }

                // Update the product quantity
                if($request->exist_qty[$key] > 0){
                    $product_qty = $product->qty + $request->exist_qty[$key];
                    $qty = $product_qty - $request->pr_qty[$key];
                    $product->update([
                        'qty' => $qty,
                        'updated_at' => Carbon::now()
                    ]);
                }else{
                    $qty = $product->qty - $request->pr_qty[$key];
                    $product->update([
                        'qty' => $qty,
                        'updated_at' => Carbon::now()
                    ]);
                }
            }
            if($request->pay_amount>0){
                $payment_id=Payment::insert([
                    'sale_id'=>$sale_id,
                    'pay_amount'=>$request->pay_amount,
                    'pay_date'=>Carbon::now(),
                    'pay_type'=>$request->pay_type,
                    'pay_note'=>$request->pay_note,
                    'created_at'=>Carbon::now(),
                ]);
            }
            $notification = array(
                'message' => 'sale Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.sale')->with($notification);
            }


    }
    // End sale Update Item

    // Start sale Delete Item
    public function DeleteSale($id){

        $sale = Sale::findOrFail($id);
        if(!empty($sale->attach_file)){
            @unlink($sale->attach_file);
        }

        $customer=Customer::findOrFail($sale->customer_id);
        $debit = $customer->debit - $sale->pay_due;
        $p_amount = $sale->amount - $sale->pay_due;
        $old_debit = $customer->old_debit - $p_amount;
        Customer::findOrFail($sale->customer_id)->update([
            'debit'=>$debit,
            'old_debit'=>$old_debit,
            'updated_at'=>Carbon::now()
        ]);

        $items = ProductItem::where('sale_id',$sale->id)->get();
        foreach($items as $key => $item){
            $item->delete();

            $qty=Product::findOrFail($item->product_id)->qty + $item->quantity;
            Product::findOrFail($item->product_id)->update([
                'qty'=> $qty ,
                'updated_at'=>Carbon::now()
            ]);
        }


        $sale->delete();
        $notification = array(
            'message' => 'sale Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // End sale Delete Item

    // Start sale PayNow sale
    public function SalePayNow(Request $request){
        $sale=Sale::findOrFail($request->sale_id);
        if($request->pay_amount > 0 && $request->pay_amount <= $sale->pay_due){
            $pay_due =  $sale->pay_due-$request->pay_amount;

            if ($pay_due >0) {
                $pay_status = 'partial';
            }else if($pay_due == 0) {
                $pay_status = 'paid';
            }

            $customer=Customer::findOrFail($sale->customer_id);
            $debit = $customer->debit - $request->pay_amount;
            $old_debit = $customer->old_debit + $request->pay_amount;
            $customer->update([
                'debit'=>$debit,
                'old_debit'=>$old_debit,
                'updated_at'=>Carbon::now()
            ]);

        }else if($request->pay_amount > $sale->pay_due ){
            $notification = array(
                'message' => 'Your Amount Greater than Your Due',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $pay_status = $sale->pay_status;
            $pay_due=$sale->pay_due;
        }

        // Update the sale record
        Sale::findOrFail($request->sale_id)->update([
            'pay_status'=>$pay_status,
            'pay_due'=>$pay_due,
            'updated_at' => Carbon::now()
        ]);

        Payment::insert([
            'sale_id'=>$request->sale_id,
            'pay_amount'=>$request->pay_amount,
            'pay_date'=>Carbon::now(),
            'pay_type'=>$request->pay_type,
            'pay_note'=>$request->pay_note,
            'created_at'=>Carbon::now(),
        ]);


        $notification = array(
            'message' => 'sale Paid Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    // End sale PayNow sale


    // Start sale Invoice Pdf
    public function SaleInvoicePdf($id) {

    $products = Product::orderBy('pr_name','ASC')->get();
    $sale = Sale::findOrFail($id);
    $items = ProductItem::where('sale_id',$id)->get();
    $payments = Payment::where('sale_id',$id)->get();
    $customers = Customer::orderBy('name','ASC')->get();

    $pdf = PDF::loadView('pages.sale.sale_pdf',compact('sale','products','items','customers','payments'))->setOptions(['defaultFont' => 'sans-serif']);
    return $pdf->stream('sale.pdf');

  }
    // End sale Invoice Pdf

    // Start sale Invoice Download
   public function SaleInvoiceDownload($id) {

    $products = Product::orderBy('pr_name','ASC')->get();
    $sale = Sale::findOrFail($id);
    $items = ProductItem::where('sale_id',$id)->get();
    $payments = Payment::where('sale_id',$id)->get();
    $customers = Customer::orderBy('name','ASC')->get();
    $pdf = PDF::loadView('pages.sale.sale_pdf',compact('sale','products','items','customers','payments'))->setOptions(['defaultFont' => 'sans-serif']);
    return $pdf->download('sale.pdf');
  }
    // End sale Invoice Download

    // Start sale Invoice Download
   public function SaleInvoicePrint($id) {

    $products = Product::orderBy('pr_name','ASC')->get();
    $sale = Sale::findOrFail($id);
    $items = ProductItem::where('sale_id',$id)->get();
    $payments = Payment::where('sale_id',$id)->get();
    $customers = Customer::orderBy('name','ASC')->get();
    $pdf = PDF::loadView('pages.sale.sale_pdf',compact('sale','products','items','customers','payments'))->setOptions(['defaultFont' => 'sans-serif']);

   return $pdf->stream('sale_invoice.pdf')->header('Content-Type', 'application/pdf');

  }
    // End sale Invoice Download

    // Start sale Return
    public function SaleReturn($id) {
        Sale::findOrFail($id)->update([
            'return_status' => 1,
            'return_date' => Carbon::now(),
        ]);


        $items = ProductItem::where('sale_id',$id)->get();
        foreach($items as $key => $item){
            $qty=Product::findOrFail($item->product_id)->qty + $item->quantity;
            Product::findOrFail($item->product_id)->update([
                'qty'=> $qty ,
                'updated_at'=>Carbon::now()
            ]);
        }

        $notification = array(
            'message' => 'sale Returned Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    // End sale Return

    // Start sale Return Method
    public function ReturnSale(){
        $sales = Sale::where('return_status',1)->orderBy('id','DESC')->get();
        return view('pages.sale.sale_return',compact('sales'));
    }
    // End sale Return Method



}
