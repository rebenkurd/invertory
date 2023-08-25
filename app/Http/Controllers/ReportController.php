<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Payment;
use App\Models\Invertory;
use App\Models\ProductItem;
use Carbon\Carbon;


class ReportController extends Controller
{

    // Start sale All Method
    public function SaleReport(){
        $sales = Sale::latest()->get();
        $customers = Customer::orderBy('name','ASC')->get();
        return view('pages.report.sale_report',compact('sales','customers'));
    }
    // End sale All Method

    // Start sale All Method
    public function ReportByDate(Request $request){

        $data = Sale::with('invertory','customer')->where('sale_date','>=',$request->date_from)->where('sale_date','<=',$request->date_to)->get();
        return response()->json(['data'=>$data]);
    }
    // End sale All Method

    // Start sale All Method
    public function ReportSaleSubmit(Request $request){
        $customer_id = $request->customer_id;
        $pay_status = $request->pay_status;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        if(!empty($customer_id) && empty($date_from) && empty($date_to) && empty($pay_status)){
            $data = Sale::with('invertory','customer')->where('customer_id',$customer_id)->get();
            return view('pages.report.sale_report_preview',compact('data'));

        }elseif(!empty($pay_status) && empty($customer_id) && empty($date_from) && empty($date_to) ){
            $data = Sale::with('invertory','customer')->where('pay_status',$pay_status)->get();
            return view('pages.report.sale_report_preview',compact('data'));
        }elseif(!empty($date_from) && !empty($date_to) && empty($pay_status) && empty($customer_id)){
            $data = Sale::with('invertory','customer')->where('sale_date','>=',$date_from)->where('sale_date','<=',$date_to)->get();
            return view('pages.report.sale_report_preview',compact('data'));
        }elseif (!empty($customer_id) && !empty($pay_status && empty($date_from) && empty($date_to))) {
            $data = Sale::with('invertory','customer')->where('customer_id',$customer_id)->where('pay_status',$pay_status)->get();
            return view('pages.report.sale_report_preview',compact('data'));
        }elseif (!empty($customer_id) && !empty($pay_status && !empty($date_from) && !empty($date_to))) {
            $data = Sale::with('invertory','customer')->where('sale_date','>=',$date_from)->where('sale_date','<=',$date_to)->where('customer_id',$customer_id)->where('pay_status',$pay_status)->get();
            return view('pages.report.sale_report_preview',compact('data'));
        }if (!empty($customer_id) && empty($pay_status && !empty($date_from) && !empty($date_to))) {
            $data = Sale::with('invertory','customer')->where('sale_date','>=',$date_from)->where('sale_date','<=',$date_to)->where('customer_id',$customer_id)->get();
            return view('pages.report.sale_report_preview',compact('data'));
        }if (empty($customer_id) && !empty($pay_status && !empty($date_from) && !empty($date_to))) {
            $data = Sale::with('invertory','customer')->where('sale_date','>=',$date_from)->where('sale_date','<=',$date_to)->where('pay_status',$pay_status)->get();
            return view('pages.report.sale_report_preview',compact('data'));
        }else{
            $notification = array(
                'message' => 'Please Enter an Information',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    // End sale All Method


}
