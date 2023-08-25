@extends('dashboard')
@section('content')

<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Edit customer</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('all.customer')}}">All customer</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit customer</a>
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
                            <h4 class="card-title">Edit customer</h4>
                        </div>
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{route('update.customer',$customer->id)}}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="customer-name">customer Name</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="customer-name" value="{{$customer->name}}" class="form-control" name="name" placeholder="customer Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="email-id">customer Email</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="email" id="email-id" value="{{$customer->email}}" class="form-control" name="email" placeholder="customer Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="mobile">customer Mobile</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="mobile" value="{{$customer->mobile}}" class="form-control" name="mobile" placeholder="customer Mobile">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="phone">customer Phone</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="phone" value="{{$customer->phone}}" class="form-control" name="phone" placeholder="customer Phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="address">customer Address</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <textarea name="address" id="address" placeholder="customer Address" class="form-control">{{$customer->address}}</textarea>
                                            </div>
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


@endsection
