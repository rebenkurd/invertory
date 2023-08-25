@extends('dashboard')
@section('content')


<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">sale Details</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('all.sale')}}">All sale</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">sale Details</a>
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
                            <h4 class="card-title">sale Details</h4>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 row ">
                                        <h2>customer Details</h2>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">customerID: </span><span>#{{ $sale->customer->customer_id }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Name: </span><span class="text-capitalize">{{ $sale->customer->name }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Email: </span><span class="text-capitalize">{{ $sale->customer->email }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Phone: </span><span class="text-capitalize">{{ $sale->customer->phone }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Mobile: </span><span class="text-capitalize">{{ $sale->customer->mobile }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Address: </span><span class="text-capitalize">{{ $sale->customer->address }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 row ">
                                        <h2>Invertory Details</h2>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Name: </span><span class="text-capitalize">{{ $sale->invertory->name }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Email: </span><span class="text-capitalize">{{ $sale->invertory->email }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Phone: </span><span class="text-capitalize">{{ $sale->invertory->phone }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Mobile: </span><span class="text-capitalize">{{ $sale->invertory->mobile }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Address: </span><span class="text-capitalize">{{ $sale->invertory->address }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 row ">
                                        <h2>sale Details</h2>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Invoice No: </span><span>#{{ $sale->invoice_no }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Currency: </span><span class="text-uppercase">{{ $sale->currency }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Pay Status: </span>
                                            @if ($sale->pay_status == 'paid')
                                            <span class="badge badge-light-success">Paid</span>
                                            @elseif($sale->pay_status == 'partial')
                                            <span class="badge badge-light-warning">Partial</span>
                                            @else
                                            <span class="badge badge-light-danger">Unpaid</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Amount: </span><span class="text-capitalize">{{$sale->currency =='iqd' ? $sale->amount.'IQD': '$'.$sale->amount }}</span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">Pay Due: </span><span class="text-capitalize"></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="fw-bolder fs-5">sale Date: </span><span class="text-capitalize">{{ $sale->sale_date }}</span>
                                        </div>
                                        @if ($sale->return_status == 1)
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
                                                        <td><span class="fw-bolder" id="grand_total_amount">{{$sale->amount}}</span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-6 mt-3">
                                        <div class="mb-1">
                                            <label class="form-label" for="notes">Notes</label>
                                            <p>{{ $sale->notes }}</p>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-3 offset-2">
                                        <div class="mb-1">
                                            <h3>Total sale:
                                            <span class="fw-bolder" id="total_sale">{{$sale->amount}}</span>
                                            <input type="hidden" name="amount" id="total_sale_input">
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
                                                        $payments = App\Models\Payment::where('sale_id',$sale->id)->get();
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
                                        <a href="{{ route('sale.invoice.print',$sale->id) }}" class="btn btn-primary me-1 waves-effect waves-float waves-light"><span data-feather="printer"></span> Print</a>
                                        <a href="{{ route('sale.invoice.download',$sale->id) }}" class="btn btn-warning me-1 waves-effect waves-float waves-light"><span data-feather="download"></span> Download</a>
                                        @if ($sale->return_status == 0)
                                        <a href="{{ route('sale.return',$sale->id) }}" class="btn btn-danger me-1 waves-effect waves-float waves-light"><i data-feather='rotate-ccw'></i> Return sale</a>
                                        @endif
                                        <a href="{{ route('edit.sale',$sale->id) }}"  class="btn btn-success me-1 waves-effect waves-float waves-light"><span data-feather="edit-2"></span> Edit</a>
                                        <a href="{{ route('sale.invoice.pdf',$sale->id) }}" target="_blank" class="btn btn-info me-1 waves-effect waves-float waves-light"><span class="fa-regular fa-file-pdf"></span> PDF</a>
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
