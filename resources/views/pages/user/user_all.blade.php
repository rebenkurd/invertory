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
                                <h3>All User</h3>
                                <a href="{{route('add.user')}}" class="btn btn-primary waves-effect"><i data-feather="plus"></i> Add User</a>
                            </div>

                                <table id="table" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $item )
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                @if (!empty($item->image))
                                                    <div class="avatar">
                                                        <img src="{{asset($item->image)}}" alt="avatar" width="42" height="42">
                                                        <span class="avatar-status-online"></span>
                                                    </div>
                                                @else
                                                    <div class="avatar bg-primary">
                                                        <div class="avatar-content text-uppercase">{{Illuminate\Support\Str::substr($item->email,0,2)}}</div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->username}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->role}}</td>
                                            <td>
                                                @if ($item->status == "active")
                                                <span class="badge rounded-pill badge badge-light-success">Active</span>
                                                @else
                                                <span class="badge rounded-pill badge badge-light-danger">InActive</span>
                                                @endif
                                            </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light " data-bs-toggle="dropdown" aria-expanded="true"><span data-feather="more-vertical"></span></button>
                                                        <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-93px, 23px);">
                                                            <a class="dropdown-item" href="{{route('edit.user',$item->id)}}">
                                                                <span data-feather="edit-2"class="me-50"></span>
                                                                <span>Edit</span>
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('delete.user',$item->id)}}" id="row-delete">
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
