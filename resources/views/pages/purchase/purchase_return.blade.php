
@extends('dashboard')
@section('content')

<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
    </div>
    <div class="content-body">
                <!-- Basic table -->
                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="card p-2">
                            <div class="card-header ">
                                <h3>All Purchase</h3>
                                <a href="{{route('add.purchase')}}" class="btn btn-primary waves-effect"><i data-feather="plus"></i> Add Purchase</a>
                            </div>

                                <table id="table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Invoice No.</th>
                                            <th>Invertory</th>
                                            <th>Supplier</th>
                                            <th>Payment Status</th>
                                            <th>Grand Total</th>
                                            <th>Payment Due</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchases as $key => $item )
                                        <tr>
                                            <td>{{$item->purchase_date}}</td>
                                            <td>{{$item->invoice_no}}
                                                @if ($item->return_status == 1)
                                                    <span class="badge badge-light-danger">Returned</span>
                                                @endif
                                            </td>
                                            <td>{{$item->invertory->name}}</td>
                                            <td>{{$item->supplier->name}}</td>
                                            <td>
                                                @if ($item->pay_status == 'paid')
                                                    <span class="badge badge-light-success">Paid</span>
                                                @elseif($item->pay_status == 'partial')
                                                    <span class="badge badge-light-warning">Partial</span>
                                                @elseif($item->pay_status == 'unpaid')
                                                    <span class="badge badge-light-danger">Unpaid</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{$item->currency == 'iqd' ? $item->amount ."IQD":'$'.$item->amount}}
                                            </td>
                                            <td>{{$item->pay_due}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light " data-bs-toggle="dropdown" aria-expanded="true"><span data-feather="more-vertical"></span></button>
                                                    <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-93px, 23px);">
                                                        <a class="dropdown-item" href="{{route('details.purchase',$item->id)}}">
                                                            <span data-feather="eye"class="me-50"></span>
                                                            <span>View</span>
                                                        </a>
                                                        <a class="dropdown-item" href="{{route('edit.purchase',$item->id)}}">
                                                            <span data-feather="edit-2"class="me-50"></span>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item"  href="{{route('delete.purchase',$item->id)}}" id="row-delete">
                                                            <span data-feather="trash"class="me-50"></span>
                                                            <span>Delete</span>
                                                        </a>
                                                        @if ($item->pay_due != 0 && $item->pay_status != 'paid')
                                                        <hr>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#pay-now{{ $key }}"  href="javascript:void(0);" id="{{ $item->id }}" onclick="Paid(this.id)" >
                                                            <span data-feather="trash"class="me-50"></span>
                                                            <span>Pay Now</span>
                                                        </a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                                <!-- Payment Form Modal-->
                                                <div class="modal text-start" id="pay-now{{ $key }}" tabindex="-1" aria-labelledby="payment" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg ">
                                                        <form action="{{ route('purchase.paynow') }}" id="pay-now-form" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="purchase_id" value="{{ $item->id }}" id="purchase_id">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="payment">Pay Now</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-xl-6 col-md-6 col-12">
                                                                            <div class="mb-1 form-group">
                                                                                <label class="form-label" for="pay_amount">Payment Amount</label>
                                                                                <input class="form-control" placeholder="Payment Amount" name="pay_amount" id="pay_amount"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-6 col-md-6 col-12">
                                                                            <div class="mb-1 form-group">
                                                                                <label class="form-label form-group" for="pay_type">Payment Type</label>
                                                                                <select class="form-control" name="pay_type" id="pay_type">
                                                                                    <option value="">Select a type</option>
                                                                                    <option value="cash">Cash</option>
                                                                                    <option value="paypal">Paypal</option>
                                                                                    <option value="card">Card</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xl-12 col-md-12 col-12">
                                                                            <div class="mb-1 form-group">
                                                                                <label class="form-label" for="pay_note">Payment Note</label>
                                                                                <textarea class="form-control" placeholder="Payment Note" name="pay_note" id="pay_note"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xl-12 col-md-12 col-12">
                                                                            <div class="row bg-light-secondary rounded-1 pt-1">
                                                                                <div class="col-2 offset-1">
                                                                                    <h5>No.</h5>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <h5>Pay Date</h5>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <h5>Pay Type</h5>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <h5>Pay Amount</h5>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <h5>Pay Note</h5>
                                                                                </div>
                                                                            </div>

                                                                            @php
                                                                                $payments=App\Models\Payment::where('purchase_id',$item->id)->get();
                                                                            @endphp
                                                                            @foreach ($payments as $key=>$item )
                                                                            <div class="row py-1 border-bottom">
                                                                                <div class="col-2 offset-1">
                                                                                    <h6>{{ $key+1 }}</h6>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <h6>{{ Carbon\Carbon::parse($item->pay_date)->format('d/m/Y') }}</h6>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <h6>{{ $item->pay_type }}</h6>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <h6>{{ $item->pay_amount }}</h6>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <h6>{{ $item->pay_note }}</h6>
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" id="btn-paid" class="btn btn-primary">Paid</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                         </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>

                <!--/ Basic table -->
    </div>
</div>
<script>



    // var site_url="https://invertory.dev";
    // function Paid(id){
    //     $('#pay-now-form').each(ele=>{
    //         $(ele+' #purchase_id').val(id)
    //     })
    // }



</script>

<script>
    // $('#btn-paid').click(function(){

    //     var purchase_id=$('#purchase_id').val();
    //     var pay_amount=$('#pay_amount').val();
    //     var pay_type=$('#pay_type').val();
    //     var pay_note=$('#pay_note').val();
    //     $.ajax({
    //         url:'/purchase/pay-now',
    //         method:'POST',
    //         dataType:'json',
    //         data:{
    //             purchase_id:purchase_id,
    //             pay_amount:pay_amount,
    //             pay_type:pay_type,
    //             pay_note:pay_note,
    //         },
    //         success:function(response){
    //             $('#pay-now').modal('hide')
    //             console.log(response.msg)
    //         }
    //     })

    // }
    // )
</script>

<script>
	$(document).ready(function(){
        if ($('#pay-now-form').length) {
            $('#pay-now-form').validate({
            rules: {
                pay_amount: {
                    required : true,
                },
                pay_type: {
                    required : true,
                },
            },
            messages :{
                pay_amount: {
                    required : 'Please Enter Pay Amount',
                },
                pay_type: {
                    required : 'Please Select a Pay Type',
                },

            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
        }
    });
</script>
@endsection
