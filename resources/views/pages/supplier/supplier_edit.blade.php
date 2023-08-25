@extends('dashboard')
@section('content')

<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Edit Supplier</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('all.supplier')}}">All Supplier</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit Supplier</a>
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
                            <h4 class="card-title">Edit Supplier</h4>
                        </div>
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{route('update.supplier',$supplier->id)}}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="supplier-name">Supplier Name</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="supplier-name" value="{{$supplier->name}}" class="form-control" name="name" placeholder="Supplier Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="email-id">Supplier Email</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="email" id="email-id" value="{{$supplier->email}}" class="form-control" name="email" placeholder="Supplier Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="mobile">Supplier Mobile</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="mobile" value="{{$supplier->mobile}}" class="form-control" name="mobile" placeholder="Supplier Mobile">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="phone">Supplier Phone</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="phone" value="{{$supplier->phone}}" class="form-control" name="phone" placeholder="Supplier Phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="address">Supplier Address</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <textarea name="address" id="address" placeholder="Supplier Address" class="form-control">{{$supplier->address}}</textarea>
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
