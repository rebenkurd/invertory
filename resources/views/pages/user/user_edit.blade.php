@extends('dashboard')
@section('content')

<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Edit User</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('all.user')}}">All User</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit User</a>
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
                            <h4 class="card-title">Edit User</h4>
                        </div>
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{route('update.user',$user->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="full-name">Full Name</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="full-name" value="{{$user->name}}" class="form-control" name="name" placeholder="Full Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="email-id">Email</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="email" id="email-id" value="{{$user->email}}" class="form-control" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="username">Username</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="username" value="{{$user->username}}" class="form-control" name="username" placeholder="username">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="">Role</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="role" {{$user->role == 'admin'?'checked':''}} id="admin" value="admin" >
                                                    <label class="form-check-label" for="admin">Admin</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="role" id="user" {{$user->role == 'user'?'checked':''}} value="user">
                                                    <label class="form-check-label" for="user">User</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="">Status</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="col-sm-5">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status" {{$user->status == 'active'?'checked':''}} id="active" value="active">
                                                        <label class="form-check-label" for="active">Active</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status" {{$user->status == 'inactive'?'checked':''}} id="inactive" value="inactive" >
                                                        <label class="form-check-label" for="inactive">InActive</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="phone">Phone</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="phone" class="form-control" value="{{$user->phone}}" name="phone" placeholder="phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="address">Address</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <textarea name="address" id="address" placeholder="Address" class="form-control"> {{$user->address}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="image">Image</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="file" id="image" class="form-control" name="image" placeholder="image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                             <img id="showImage" src="{{!empty($user->image)?asset($user->image):url('uploads/no_image.jpg')}}" class="border-primary rounded-3" alt="Admin" style="width:100px; height: 100px;"  >
                                        </div>
                                    </div>
                                    <div class="col-sm-9 offset-sm-3">
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

@endsection
