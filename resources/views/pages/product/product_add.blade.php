@extends('dashboard')
@section('content')

<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Add Product</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('all.product')}}">All Product</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{route('add.product')}}">Add Product</a>
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
                            <h4 class="card-title">Add Product</h4>
                        </div>
                        <div class="card-body">
                            <form id="form-validate" class="form form-horizontal" method="POST" action="{{route('store.product')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1 ">
                                                <label class="form-label" for="pr_code">Product Code</label>
                                                <input type="text" class="form-control" name="pr_code" id="pr_code" placeholder="Product Code">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1 form-group">
                                                <label class="form-label" for="pr_name">Product name</label>
                                                <input type="text" class="form-control" name="pr_name" id="pr_name" placeholder="Product name">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="image">Product image</label>
                                                <input type="file" class="form-control" name="pr_image" id="image">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                        <div class="col-xl-8 col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="stock_manage">Stock Manage</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" name="stock" type="checkbox" id="stock_manage" value="1" checked="">
                                                    <label class="form-check-label" for="stock_manage">Enable</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"> </h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                 <img id="showImage" src="{{url('uploads/no_product_image.png')}}" class="border-primary rounded-3" alt="Admin" style="width:100px; height: 100px;"  >
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="col-form-label" for="">Currencies : </label>
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
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1 form-group">
                                                    <label class="form-label" for="price">Product Price</label>
                                                    <input type="text" class="form-control" name="price" id="price" placeholder="Product price">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="xmargin">X Margin(%)</label>
                                                    <input type="text" class="form-control" name="x_margin" id="xmargin" placeholder="X Margin(%)">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="selling_price">Selling Price</label>
                                                    <input type="text" class="form-control" name="selling_price" id="selling_price" placeholder="Selling Price">
                                                </div>
                                            </div>
                                    </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="notes">Additional Notes</label>
                                            <textarea class="form-control" name="notes" id="notes" placeholder="Additional Notes"></textarea>
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


<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>


<script>
	$(document).ready(function(){
        if ($('#form-validate').length) {
            $('#form-validate').validate({
            rules: {
                pr_name: {
                    required : true,
                },
                price: {
                    required : true,
                },
            },
            messages :{
                pr_name: {
                    required : 'Please Enter Product Name',
                },
                price: {
                    required : 'Please Enter Price',
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

    $('#xmargin , #price').keyup(function(){
        var xmargin=parseFloat($('#xmargin').val());
        var price=parseFloat($('#price').val());
        if(xmargin >= 0){
            var margin =  price * xmargin /100;
            var sell = price + margin;
        }else{
            var sell = price;
        }
        $('#selling_price').val(parseFloat(sell).toFixed(2));
    })

</script>



@endsection
