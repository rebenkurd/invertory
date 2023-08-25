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
                                <h3>All Product</h3>
                                <a href="{{route('add.product')}}" class="btn btn-primary waves-effect"><i data-feather="plus"></i> Add Product</a>
                            </div>

                                <table id="table" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Buy</th>
                                            <th>Quantity</th>
                                            <th>Sell</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $item )
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                @if (!empty($item->pr_image))
                                                    <div class="avatar">
                                                        <img src="{{asset($item->pr_image)}}" alt="avatar" width="52" height="52">
                                                    </div>
                                                @else
                                                    <div class="avatar bg-primary">
                                                        <div class="avatar-content text-uppercase">pr</div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{$item->pr_name}}</td>
                                            <td>{{$item->pr_code}}</td>
                                            <td>{{$item->currency == 'iqd' ? $item->price." IQD":"$".$item->price}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>{{$item->currency == 'iqd' ? $item->selling_price." IQD":"$".$item->selling_price}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light " data-bs-toggle="dropdown" aria-expanded="true"><span data-feather="more-vertical"></span></button>
                                                    <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-93px, 23px);">
                                                        <a class="dropdown-item" href="{{route('edit.product',$item->id)}}">
                                                            <span data-feather="edit-2"class="me-50"></span>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item"  href="{{route('delete.product',$item->id)}}" id="row-delete">
                                                            <span data-feather="trash"class="me-50"></span>
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Basic table -->
    </div>
</div>

<script>

</script>
@endsection
