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
                        <h3>All Supplier</h3>
                        <a href="{{route('add.supplier')}}" class="btn btn-primary waves-effect"><i data-feather="plus"></i> Add Supplier</a>
                    </div>

                        <table id="table" class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Supplier ID</th>
                                    <th>Supplier Name</th>
                                    <th>Supplier Email</th>
                                    <th>Supplier Phone</th>
                                    <th>Supplier Mobile</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $key => $item )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->supplier_id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->mobile}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light " data-bs-toggle="dropdown" aria-expanded="true"><span data-feather="more-vertical"></span></button>
                                                <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-93px, 23px);">
                                                    <a class="dropdown-item" href="{{route('edit.supplier',$item->id)}}">
                                                        <span data-feather="edit-2"class="me-50"></span>
                                                        <span>Edit</span>
                                                    </a>
                                                    <a class="dropdown-item" href="{{route('delete.supplier',$item->id)}}" id="row-delete">
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
