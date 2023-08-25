@extends('dashboard')
@section('content')


<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Purchase Details</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('all.purchase')}}">All Purchase</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Purchase Details</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="basic-horizontal-layouts">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Purchase Details</h4>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 row ">
                                        <h2>Supplier Details</h2>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">SupplierID: </span><span>#{{ $purchase->supplier->supplier_id }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Name: </span><span class="text-capitalize">{{ $purchase->supplier->name }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Email: </span><span class="text-capitalize">{{ $purchase->supplier->email }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Phone: </span><span class="text-capitalize">{{ $purchase->supplier->phone }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Mobile: </span><span class="text-capitalize">{{ $purchase->supplier->mobile }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Address: </span><span class="text-capitalize">{{ $purchase->supplier->address }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 row ">
                                        <h2>Invertory Details</h2>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Name: </span><span class="text-capitalize">{{ $purchase->invertory->name }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Email: </span><span class="text-capitalize">{{ $purchase->invertory->email }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Phone: </span><span class="text-capitalize">{{ $purchase->invertory->phone }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Mobile: </span><span class="text-capitalize">{{ $purchase->invertory->mobile }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Address: </span><span class="text-capitalize">{{ $purchase->invertory->address }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 row ">
                                        <h2>Purchase Details</h2>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Invoice No: </span><span>#{{ $purchase->invoice_no }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Currency: </span><span class="text-uppercase">{{ $purchase->currency }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Pay Status: </span>
                                            @if ($purchase->pay_status == 'paid')
                                            <span class="badge badge-light-success">Paid</span>
                                            @elseif($purchase->pay_status == 'partial')
                                            <span class="badge badge-light-warning">Partial</span>
                                            @else
                                            <span class="badge badge-light-danger">Unpaid</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Amount: </span><span class="text-capitalize">{{$purchase->currency =='iqd' ? $purchase->amount.'IQD': '$'.$purchase->amount }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Pay Due: </span><span class="text-capitalize"></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Purchase Date: </span><span class="text-capitalize">{{ $purchase->purchase_date }}</span>
                                        </div>
                                        @if ($purchase->return_status == 1)
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Return Status: </span>
                                            <span class="badge badge-light-danger">Returned</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <h4 class="my-1">Products Details</h4>
                                    <div class="col-12 mb-2">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="items_table">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Unit Price</th>
                                                        <th>Line Total</th>
                                                        <th>Unit Selling Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($items as $key=> $item)
                                                    @php
                                                        $product = App\Models\Product::findOrFail($item->product_id);
                                                    @endphp
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$product->pr_name}}</td>
                                                        <td>{{$item->quantity}}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>{{$item->amount}}</td>
                                                        <td>{{$product->selling_price}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td><span class="fw-bolder">Net Total Amount:</span></td>
                                                        <td><span class="fw-bolder" id="grand_total_amount">{{$purchase->amount}}</span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-6 mt-3">
                                        <div class="mb-1">
                                            <label class="form-label" for="notes">Notes</label>
                                            <p>{{ $purchase->notes }}</p>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-3 offset-2">
                                        <div class="mb-1">
                                            <h3>Total Purchase:
                                            <span class="fw-bolder" id="total_purchase">{{$purchase->amount}}</span>
                                            <input type="hidden" name="amount" id="total_purchase_input">
                                        </h3>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="col-12 mb-2">
                                        <h4 class="my-1">Payment Details</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="items_table">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Pay Date</th>
                                                        <th>Pay Type</th>
                                                        <th>Pay Amount</th>
                                                        <th>Pay Note</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $payments = App\Models\Payment::where('purchase_id',$purchase->id)->get();
                                                    @endphp
                                                    @foreach ($payments as $key => $item)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$item->pay_date}}</td>
                                                        <td>{{$item->pay_type}}</td>
                                                        <td>{{$item->pay_amount }}</td>
                                                        <td>{{$item->pay_note}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <a href="{{ route('purchase.invoice.print',$purchase->id) }}" class="btn btn-primary me-1 waves-effect waves-float waves-light"><span data-feather="printer"></span> Print</a>
                                        <a href="{{ route('purchase.invoice.download',$purchase->id) }}" class="btn btn-warning me-1 waves-effect waves-float waves-light"><span data-feather="download"></span> Download</a>
                                        @if ($purchase->return_status == 0)
                                        <a href="{{ route('purchase.return',$purchase->id) }}" class="btn btn-danger me-1 waves-effect waves-float waves-light"><i data-feather='rotate-ccw'></i> Return Purchase</a>
                                        @endif
                                        <a href="{{ route('edit.purchase',$purchase->id) }}"  class="btn btn-success me-1 waves-effect waves-float waves-light"><span data-feather="edit-2"></span> Edit</a>
                                        <a href="{{ route('purchase.invoice.pdf',$purchase->id) }}" target="_blank" class="btn btn-info me-1 waves-effect waves-float waves-light"><span class="fa-regular fa-file-pdf"></span> PDF</a>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>



@endsection
