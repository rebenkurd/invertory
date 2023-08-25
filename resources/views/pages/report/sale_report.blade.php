
@extends('dashboard')
@section('content')

<div class="content-wrapper container-xxl p-0">

    <div class="content-body">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('report.sale.submit') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-1 offset-2">
                            <label for="">From:</label>
                            <input type="date" name="date_from" id="date_from" class="form-control form-control">
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="">To:</label>
                            <input type="date" name="date_to" id="date_to" class="form-control form-control">
                        </div>
                        <div class="col-md-4  offset-2 mb-1">
                            <label for="">Customer Name:</label>
                            <select name="customer_id" id="" class="form-select">
                                <option value="">Select a Customer</option>
                                @foreach ($customers as $cust)
                                <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-1">
                                <label for="">Payment Status:</label>
                                <select name="pay_status" id="" class="form-select">
                                    <option value="">Select a Payment Status</option>
                                    <option value="paid">Paid</option>
                                    <option value="partial">Partial</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                        </div>
                        <div class="col-md-4 offset-2 mb-1">
                            <button type="submit" class="btn btn-primary">Report</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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



<script>
    // $('#date_from,#date_to').change(function(){
    //     var date_from=$('#date_from').val();
    //     var date_to=$('#date_to').val();
    //     if(date_from != '' && date_to != ''){
    //     $.ajax({
    //         url:'/report/report_by_date',
    //         method:'POST',
    //         dataType:'json',
    //         data:{
    //             date_from:date_from,
    //             date_to:date_to,
    //         },
    //         success:function(response){
    //             var data = response.data;
    //             $('#table-report tbody').html('')
    //             for (let i = 0; i < data.length; i++) {
    //                 $('#table-report tbody').append(`
    //                     <tr>
    //                         <td>${response.data[i].sale_date}</td>
    //                         <td>${response.data[i].invoice_no}</td>
    //                         <td>${response.data[i].invertory.name}</td>
    //                         <td>${response.data[i].customer.name}</td>
    //                         <td>${response.data[i].pay_status}</td>
    //                         <td>${response.data[i].amount}</td>
    //                         <td>${response.data[i].pay_due}</td>
    //                     </tr>
    //                 `)
    //             }
    //         }
    //     })
    // }
    // }
    // )
</script>

@endsection
