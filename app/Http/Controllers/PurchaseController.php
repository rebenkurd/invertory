<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Payment;
use App\Models\Invertory;
use App\Models\ProductItem;
use Carbon\Carbon;
use Illuminate\Http\Response;

use Barryvdh\DomPDF\Facade\Pdf;
class PurchaseController extends Controller{
    // Start Purchase All Method
    public function AllPurchase(){
        $purchases = Purchase::latest()->get();
        return view('pages.purchase.purchase_all',compact('purchases'));
    }
    // End Purchase All Method

    // Start Purchase Add Method
    public function AddPurchase(){
        $products = Product::orderBy('pr_name','ASC')->get();
        $suppliers = Supplier::orderBy('name','ASC')->get();
        return view('pages.purchase.purchase_add',compact('products','suppliers'));
    }
    // End Purchase Add Method

    // Start Purchase Ajax Product Item
    public function AjaxProductItem($id){
        $data = Product::where('id',$id)->first();
        return response()->json($data);
    }
    // End Purchase Ajax Product Item

    // Start Purchase Store Item
    public function StorePurchase(Request $request){


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

        $supplier_debit=Supplier::findOrFail($request->supplier_id)->debit;

        $debit = $supplier_debit+$pay_due;
        Supplier::findOrFail($request->supplier_id)->update([
            'debit'=>$debit,
            'updated_at'=>Carbon::now()
        ]);

        $invertory_id = Invertory::first()->id;

        if ($request->file('attach_file')) {
            $count_purchase= Purchase::count();
            if($count_purchase>0){
                $latest_purchase= Purchase::latest()->first()->id;
                $invoiceno_gen = 'PR'.str_pad($latest_purchase+1,6,0,STR_PAD_LEFT);
            }else{
                $invoiceno_gen = 'PR'.str_pad(0+1,6,0,STR_PAD_LEFT);
            }
        $file = $request->file('attach_file');
        $name_gen = hexdec(uniqid()).'_invoice.'.$file->getClientOriginalExtension();
        $file->move('uploads/invoices/',$name_gen);
        $save_url = 'uploads/invoices/'.$name_gen;



        if(!$request->invoice_no){
            $purchase_id=Purchase::insertGetId([
                'supplier_id'=>$request->supplier_id,
                'invoice_no'=>$invoiceno_gen,
                'purchase_date'=>$request->purchase_date,
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
            $purchase_id=Purchase::insertGetId([
                'supplier_id'=>$request->supplier_id,
                'invoice_no'=>$request->invoice_no,
                'purchase_date'=>$request->purchase_date,
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
                'purchase_id'=>$purchase_id,
                'amount'=>$request->total_amount[$key] ,
                'quantity'=>$request->pr_qty[$key],
                'created_at'=>Carbon::now()
            ]);
        }

        foreach($items as $key => $item){
            $qty=Product::findOrFail($item)->qty + $request->pr_qty[$key];
            Product::findOrFail($item)->update([
                'qty'=> $qty ,
                'updated_at'=>Carbon::now()
            ]);
        }

        if($request->pay_amount>0){
            $payment_id=Payment::insert([
                'purchase_id'=>$purchase_id,
                'pay_amount'=>$request->pay_amount,
                'pay_date'=>Carbon::now(),
                'pay_type'=>$request->pay_type,
                'pay_note'=>$request->pay_note,
                'created_at'=>Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Purchase Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.purchase')->with($notification);

        }else{
            $count_purchase= Purchase::count();
            if($count_purchase>0){
                $latest_purchase= Purchase::latest()->first()->id;
                $invoiceno_gen = 'PR'.str_pad($latest_purchase+1,6,0,STR_PAD_LEFT);
            }else{
                $invoiceno_gen = 'PR'.str_pad(0+1,6,0,STR_PAD_LEFT);

            }

            if(!$request->invoice_no){
                $purchase_id=Purchase::insertGetId([
                    'supplier_id'=>$request->supplier_id,
                    'invoice_no'=>$invoiceno_gen,
                    'purchase_date'=>$request->purchase_date,
                    'currency'=>$request->currency,
                    'invertory_id'=>$invertory_id,
                    'amount'=>$request->amount,
                    'pay_status'=>$pay_status,
                    'pay_due'=>$pay_due,
                    'notes'=>$request->notes,
                    'created_at'=>Carbon::now()
                ]);
            }else{
                $purchase_id=Purchase::insertGetId([
                    'supplier_id'=>$request->supplier_id,
                    'invoice_no'=>$request->invoice_no,
                    'purchase_date'=>$request->purchase_date,
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
                    'purchase_id'=>$purchase_id,
                    'amount'=>$request->total_amount[$key] ,
                    'quantity'=>$request->pr_qty[$key],
                    'created_at'=>Carbon::now()
                ]);
                $qty=Product::findOrFail($item)->qty + $request->pr_qty[$key];
                Product::findOrFail($item)->update([
                    'qty'=> $qty ,
                    'updated_at'=>Carbon::now()
                ]);
            }

            if($request->pay_amount>0){
                $payment_id=Payment::insert([
                    'purchase_id'=>$purchase_id,
                    'pay_amount'=>$request->pay_amount,
                    'pay_date'=>Carbon::now(),
                    'pay_type'=>$request->pay_type,
                    'pay_note'=>$request->pay_note,
                    'created_at'=>Carbon::now(),
                ]);
            }


            $notification = array(
                'message' => 'Purchase Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.purchase')->with($notification);
        }


    }
    // End Purchase Store Item

    // Start Purchase Edit Method
    public function EditPurchase($id){
        $products = Product::orderBy('pr_name','ASC')->get();
        $purchase = Purchase::findOrFail($id);
        $items = ProductItem::where('purchase_id',$id)->get();
        $payments = Payment::where('purchase_id',$id)->get();
        $suppliers = Supplier::orderBy('name','ASC')->get();
        return view('pages.purchase.purchase_edit',compact('purchase','products','items','suppliers','payments'));
    }
    // End Purchase Edit Method

    // Start Purchase Details Method
    public function DetailsPurchase($id){
        $products = Product::orderBy('pr_name','ASC')->get();
        $purchase = Purchase::findOrFail($id);
        $items = ProductItem::where('purchase_id',$id)->get();
        $payments = Payment::where('purchase_id',$id)->get();
        $suppliers = Supplier::orderBy('name','ASC')->get();
        return view('pages.purchase.purchase_details',compact('purchase','products','items','suppliers','payments'));
    }
    // End Purchase Details Method


    // Start Purchase Update Item
    public function UpdatePurchase(Request $request, $id){

        $purchase=Purchase::findOrFail($id);
        if($request->pay_amount > 0 && $request->pay_amount <= $purchase->pay_due){
            $pay_due =  $purchase->pay_due-$request->pay_amount;

            if ($pay_due >0) {
                $pay_status = 'partial';
            }else if($pay_due == 0) {
                $pay_status = 'paid';
            }

            $supplier=Supplier::findOrFail($request->supplier_id);
            $debit = $supplier->debit - $request->pay_amount;
            $old_debit = $supplier->old_debit + $request->pay_amount;
            Supplier::findOrFail($request->supplier_id)->update([
                'debit'=>$debit,
                'old_debit'=>$old_debit,
                'updated_at'=>Carbon::now()
            ]);

        }else if($request->pay_amount > $purchase->pay_due ){
            $notification = array(
                'message' => 'Your Amount Greater than Your Due',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $pay_status = $purchase->pay_status;
            $pay_due=$purchase->pay_due;
        }


        if ($request->file('attach_file')) {
            @unlink($request->file('exist_attach_file'));
            $file = $request->file('attach_file');
            $name_gen = hexdec(uniqid()).'_invoice.'.$file->getClientOriginalExtension();
            $file->move('uploads/invoices/',$name_gen);
            $save_url = 'uploads/invoices/'.$name_gen;


            // Update the purchase record
            Purchase::findOrFail($id)->update([
                'supplier_id' => $request->supplier_id,
                'purchase_date' => $request->purchase_date,
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
                $purchase_id = $id;
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
                        'purchase_id' => $purchase_id,
                        'amount' => $request->total_amount[$key],
                        'quantity' => $request->pr_qty[$key],
                        'created_at' => Carbon::now()
                    ]);
                }

                // Update the product quantity
                $qty = $product->qty + $request->pr_qty[$key];
                $product->update([
                    'qty' => $qty,
                    'updated_at' => Carbon::now()
                ]);
            }

            if($request->pay_amount>0){
                $payment_id=Payment::insert([
                    'purchase_id'=>$purchase_id,
                    'pay_amount'=>$request->pay_amount,
                    'pay_date'=>Carbon::now(),
                    'pay_type'=>$request->pay_type,
                    'pay_note'=>$request->pay_note,
                    'created_at'=>Carbon::now(),
                ]);
            }
            $notification = array(
                'message' => 'Purchase Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.purchase')->with($notification);

         }
        else{

            // Update the purchase record
            Purchase::findOrFail($id)->update([
                'supplier_id' => $request->supplier_id,
                'purchase_date' => $request->purchase_date,
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
                $purchase_id = $id;
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
                        'purchase_id' => $purchase_id,
                        'amount' => $request->total_amount[$key],
                        'quantity' => $request->pr_qty[$key],
                        'created_at' => Carbon::now()
                    ]);
                }

                // Update the product quantity
                if($request->exist_qty[$key] > 0){
                    $product_qty = $product->qty - $request->exist_qty[$key];
                    $qty = $product_qty + $request->pr_qty[$key];
                    $product->update([
                        'qty' => $qty,
                        'updated_at' => Carbon::now()
                    ]);
                }else{
                    $qty = $product->qty + $request->pr_qty[$key];
                    $product->update([
                        'qty' => $qty,
                        'updated_at' => Carbon::now()
                    ]);
                }
            }
            if($request->pay_amount>0){
                $payment_id=Payment::insert([
                    'purchase_id'=>$purchase_id,
                    'pay_amount'=>$request->pay_amount,
                    'pay_date'=>Carbon::now(),
                    'pay_type'=>$request->pay_type,
                    'pay_note'=>$request->pay_note,
                    'created_at'=>Carbon::now(),
                ]);
            }
            $notification = array(
                'message' => 'Purchase Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.purchase')->with($notification);
            }


    }
    // End Purchase Update Item

    // Start Purchase Delete Item
    public function DeletePurchase($id){

        $purchase = Purchase::findOrFail($id);
        if(!empty($purchase->attach_file)){
            @unlink($purchase->attach_file);
        }

        $supplier=Supplier::findOrFail($purchase->supplier_id);
        $debit = $supplier->debit - $purchase->pay_due;
        $p_amount = $purchase->amount - $purchase->pay_due;
        $old_debit = $supplier->old_debit - $p_amount;
        Supplier::findOrFail($purchase->supplier_id)->update([
            'debit'=>$debit,
            'old_debit'=>$old_debit,
            'updated_at'=>Carbon::now()
        ]);

        $items = ProductItem::where('purchase_id',$purchase->id)->get();
        foreach($items as $key => $item){
            $item->delete();

            $qty=Product::findOrFail($item->product_id)->qty - $item->quantity;
            Product::findOrFail($item->product_id)->update([
                'qty'=> $qty ,
                'updated_at'=>Carbon::now()
            ]);
        }


        $purchase->delete();
        $notification = array(
            'message' => 'Purchase Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // End Purchase Delete Item

    // Start Purchase PayNow Purchase
    public function PurchasePayNow(Request $request){
        $purchase=Purchase::findOrFail($request->purchase_id);
        if($request->pay_amount > 0 && $request->pay_amount <= $purchase->pay_due){
            $pay_due =  $purchase->pay_due-$request->pay_amount;

            if ($pay_due >0) {
                $pay_status = 'partial';
            }else if($pay_due == 0) {
                $pay_status = 'paid';
            }

            $supplier=Supplier::findOrFail($purchase->supplier_id);
            $debit = $supplier->debit - $request->pay_amount;
            $old_debit = $supplier->old_debit + $request->pay_amount;
            $supplier->update([
                'debit'=>$debit,
                'old_debit'=>$old_debit,
                'updated_at'=>Carbon::now()
            ]);

        }else if($request->pay_amount > $purchase->pay_due ){
            $notification = array(
                'message' => 'Your Amount Greater than Your Due',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $pay_status = $purchase->pay_status;
            $pay_due=$purchase->pay_due;
        }

        // Update the purchase record
        Purchase::findOrFail($request->purchase_id)->update([
            'pay_status'=>$pay_status,
            'pay_due'=>$pay_due,
            'updated_at' => Carbon::now()
        ]);

        Payment::insert([
            'purchase_id'=>$request->purchase_id,
            'pay_amount'=>$request->pay_amount,
            'pay_date'=>Carbon::now(),
            'pay_type'=>$request->pay_type,
            'pay_note'=>$request->pay_note,
            'created_at'=>Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Purchase Paid Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    // End Purchase PayNow Purchase


    // Start Purchase Invoice Pdf
    public function PurchaseInvoicePdf($id) {

    $products = Product::orderBy('pr_name','ASC')->get();
    $purchase = Purchase::findOrFail($id);
    $items = ProductItem::where('purchase_id',$id)->get();
    $payments = Payment::where('purchase_id',$id)->get();
    $suppliers = Supplier::orderBy('name','ASC')->get();

    $pdf = PDF::loadView('pages.purchase.purchase_pdf',compact('purchase','products','items','suppliers','payments'))->setOptions(['defaultFont' => 'sans-serif']);
    return $pdf->stream('purchase.pdf');

  }
    // End Purchase Invoice Pdf

    // Start Purchase Invoice Download
   public function PurchaseInvoiceDownload($id) {

    $products = Product::orderBy('pr_name','ASC')->get();
    $purchase = Purchase::findOrFail($id);
    $items = ProductItem::where('purchase_id',$id)->get();
    $payments = Payment::where('purchase_id',$id)->get();
    $suppliers = Supplier::orderBy('name','ASC')->get();
    $pdf = PDF::loadView('pages.purchase.purchase_pdf',compact('purchase','products','items','suppliers','payments'))->setOptions(['defaultFont' => 'sans-serif']);
    return $pdf->download('purchase.pdf');
  }
    // End Purchase Invoice Download

    // Start Purchase Invoice Download
   public function PurchaseInvoicePrint($id) {

    $products = Product::orderBy('pr_name','ASC')->get();
    $purchase = Purchase::findOrFail($id);
    $items = ProductItem::where('purchase_id',$id)->get();
    $payments = Payment::where('purchase_id',$id)->get();
    $suppliers = Supplier::orderBy('name','ASC')->get();
    $pdf = PDF::loadView('pages.purchase.purchase_pdf',compact('purchase','products','items','suppliers','payments'))->setOptions(['defaultFont' => 'sans-serif']);

   return $pdf->stream('purchase_invoice.pdf')->header('Content-Type', 'application/pdf');

  }
    // End Purchase Invoice Download

    // Start Purchase Return
    public function PurchaseReturn($id) {
        Purchase::findOrFail($id)->update([
            'return_status' => 1,
            'return_date' => Carbon::now(),
        ]);


        $items = ProductItem::where('purchase_id',$id)->get();
        foreach($items as $key => $item){
            $qty=Product::findOrFail($item->product_id)->qty - $item->quantity;
            Product::findOrFail($item->product_id)->update([
                'qty'=> $qty ,
                'updated_at'=>Carbon::now()
            ]);
        }

        $notification = array(
            'message' => 'Purchase Returned Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    // End Purchase Return

    // Start Purchase Return Method
    public function ReturnPurchase(){
        $purchases = Purchase::where('return_status',1)->orderBy('id','DESC')->get();
        return view('pages.purchase.purchase_return',compact('purchases'));
    }
    // End Purchase Return Method

}


