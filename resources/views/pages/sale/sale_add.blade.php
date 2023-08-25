@extends('dashboard')
@section('content')


<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Add Sale</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('all.sale')}}">All Sale</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{route('add.sale')}}">Add Sale</a>
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
                            <h4 class="card-title">Add Sale</h4>
                        </div>
                        <div class="card-body">
                            <form id="form-validate" class="form form-horizontal" method="POST" action="{{route('store.sale')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1 form-group">
                                                <label class="form-label" for="customer_id">customer</label>
                                                <select class="form-select" name="customer_id" id="customer_id">
                                                    <option value="">Select a customer</option>
                                                    @foreach ($customers as $item )
                                                    <option value="{{ $item->id }}">{{ Illuminate\Support\Str::ucfirst($item->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1 form-group">
                                                <label class="form-label" for="invoice_no">Invoice No.</label>
                                                <div class="input-group">
                                                    <input class="form-control" placeholder="Invoice No." name="invoice_no" id="invoice_no"/>
                                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="You can Enter the Invoice number or we Automaticly make it to you" data-bs-trigger="click"><i class="fa fa-info"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1 form-group">
                                                <label class="form-label form-group" for="sale_date">sale Date</label>
                                                <input type="date" class="form-control" name="sale_date" id="sale_date">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="col-form-label" for="">Currencies : </label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="currency" id="iqd" value="iqd" checked>
                                                    <label class="form-check-label" for="iqd">IQD</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="currency" id="usd" value="usd" >
                                                    <label class="form-check-label" for="usd">USD</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1 form-group">
                                                <label class="form-label" for="attach_file">Invoice Attach</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" name="attach_file" id="attach_file">
                                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="The File Must be (1Mg) or Lower And File type should be (jpg,jpeg,png,pdf,txt)" data-bs-trigger="click"><i class="fa fa-info"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-8 offset-2">
                                        <div class="mb-1 form-group input-group">
                                            <span class="input-group-text" id="basic-addon-search1" ><i data-feather="box"></i></span>
                                            <select class="form-select form-group" name="product" id="select_items">
                                                <option value="">Product Name / #Product Code</option>
                                                @foreach ($products as $item )
                                                <option value="{{$item->id}}">{{$item->pr_name}}/#{{$item->pr_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="items_table">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Unit Price</th>
                                                        <th>Line Total</th>
                                                        <th>Unit Selling Price</th>
                                                        <th>Remove</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td><span class="fw-bolder">Net Total Amount:</span></td>
                                                        <td><span class="fw-bolder" id="grand_total_amount">0.00</span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-6 mt-3">
                                        <div class="mb-1">
                                            <label class="form-label" for="notes">Additional Notes</label>
                                            <textarea class="form-control" name="notes" id="notes" placeholder="Additional Notes"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-3 offset-2">
                                        <div class="mb-1">
                                            <h3>Total Sale:
                                            <span class="fw-bolder" id="total_sale">0.00</span>
                                            <input type="hidden" name="amount" id="total_sale_input">
                                        </h3>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="alert alert-info p-1">
                                    <p>
                                        Note: If You want Pay You can pay now Oe You Can Pay Another Time
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col-12">
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
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>

    const site_url='https://invertory.dev/';
    $("#select_items").on('change',function(e) {
        var itemId=$("#select_items").val();
        if(itemId>0){
        $.ajax({
            url:site_url+'ajax/product/item/'+itemId,
            method:'get',
            dataType:'json',
            success:function(data){
                if (!$("#tr_"+data.id).length) {
                $('#items_table tbody').append(`
                <tr id="tr_${data.id}">
                    <input type="hidden" id="${data.id}" name="pr_id[]" value="${data.id}">
                        <td><input type="text" class="form-control" name="pr_name[]" disabled value="${data.pr_name}"></td>
                        <td>
                            <div class="input-group bootstrap-touchspin">
                                <span class="input-group-btn bootstrap-touchspin-injected">
                                    <button class="btn btn-primary bootstrap-touchspin-down" id="qtydec" type="button">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </span>
                                <input type="text"  class="touchspin form-control" id="qty" value="1" name="pr_qty[]">
                                <span class="input-group-btn bootstrap-touchspin-injected">
                                    <button type="button" class="btn btn-primary bootstrap-touchspin-up" id="qtyinc" >
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                        </td>
                        <td><input type="text" class="form-control" name="price[]" id="price" value="${data.price}"></td>
                        <td><input type="text" class="form-control" id="total_amount" name="total_amount[]" value="0.00"></td>
                        <td><input type="text" class="form-control" name="selling_price" value="${data.selling_price}"></td>
                        <td><a href="javascript:void(0);" id="remove" class="text-danger"><i class="fa fa-trash"></i></a></td>
                    </tr>
                `);

                }else{
                    alert('Already Have '+ data.pr_name)
                }
            quantity();
            removeRow(data.id);
            updateGrandTotal()
            }
        })
    }

    })




    </script>

<script>
	$(document).ready(function(){
        if ($('#form-validate').length) {
            $('#form-validate').validate({
            rules: {
                product: {
                    required : true,
                },
                sale_date: {
                    required : true,
                },
            },
            messages :{
                sale_date: {
                    required : 'Please Enter sale Date',
                },
                product: {
                    required : 'Please Select a Product',
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

<script>

    function quantity() {
        $('tbody tr').each(function () {
        var $row = $(this);
        var $quantityInput = $row.find("#qty");
        var $priceInput = $row.find("#price");
        var $totalAmountInput = $row.find("#total_amount");

        function calculateTotal() {
        var quantity = parseInt($quantityInput.val());
        var price = parseFloat($priceInput.val());
        var total = quantity * price;
        $totalAmountInput.val(total.toFixed(2));
        updateGrandTotal();
        }

        function increaseQuantity() {
        var quantity = parseInt($quantityInput.val());
        $quantityInput.val(++quantity);
        calculateTotal();
        }

        function decreaseQuantity() {
        var quantity = parseInt($quantityInput.val());
        if (quantity > 1) {
            $quantityInput.val(--quantity);
            calculateTotal();
        }
        }

        $quantityInput.on('input', calculateTotal);

        $row.find('#qtyinc').off('click').on('click', increaseQuantity);
        $row.find('#qtydec').off('click').on('click', decreaseQuantity);

        calculateTotal();
    });
    }
    quantity();

    function updateGrandTotal() {
        var grandTotal = 0;
        $('tbody tr #total_amount').each(function () {
            var amount = parseFloat($(this).val());
            if (!isNaN(amount)) {
            grandTotal += amount;
            }
        });
        $("#grand_total_amount").text(grandTotal.toFixed(2));
        $("#total_sale").text(grandTotal.toFixed(2));
        $("#total_sale_input").val(grandTotal.toFixed(2));
    }

    updateGrandTotal()

</script>



<script>


    function removeRow(id) {
        $('#tr_'+id+' #remove').click(function(){
            var row = $(this).closest('tr').attr('id','tr_'+id);
            row.remove();
            updateGrandTotal()
        })

    }




</script>







@endsection
