@extends('dashboard')
@section('content')

<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Invertory Setting</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="{{route('setting.invertory')}}">Invertory Setting</a>
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
                            <h4 class="card-title">Invertory Setting</h4>
                        </div>
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{route('update.invertory.setting',$invertory->id)}}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="invertory-name">Invertory Name</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="invertory-name" value="{{$invertory->name}}" class="form-control" name="name" placeholder="Invertory Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="email-id">Invertory Email</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="email" id="email-id" value="{{$invertory->email}}" class="form-control" name="email" placeholder="Invertory Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="mobile">Invertory Mobile</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="mobile" value="{{$invertory->mobile}}" class="form-control" name="mobile" placeholder="Invertory Mobile">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="phone">Invertory Phone</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="phone" value="{{$invertory->phone}}" class="form-control" name="phone" placeholder="Invertory Phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="address">Invertory Address</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <textarea name="address" id="address" placeholder="Invertory Address" class="form-control">{{$invertory->address}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="image">Invertory Image</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="file" id="image" class="form-control" name="image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                             <img id="showImage" src="{{!empty($invertory->image)?asset($invertory->image):url('uploads/no_image.jpg')}}" class="border-primary rounded-3" alt="Admin" style="width:100px; height: 100px;"  >
                                        </div>
                                    </div>
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light">Save</button>
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
@endsection
