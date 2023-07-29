@extends('admin.layouts.master')
@section('title', 'Dashboard User ')
@section('main-header', 'User')
@section('header', 'User')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    @can('users')
                        <a class="btn btn-primary" data-bs-target="#addProduct" data-bs-toggle="modal"
                           href="javascript:void(0)">Add New User</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                            <tr>

                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0"> Name</th>
                                <th class="wd-15p border-bottom-0"> Phone</th>
                                <th class="wd-20p border-bottom-0"> Email</th>
                                <th class="wd-20p border-bottom-0"> Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user as $index=>$item)
                                <div class="modal fade" id="editProduct{{$item->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Edit Slider</h6>
                                                <button aria-label="Close" class="btn-close"
                                                        data-bs-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{route('admin.user_update')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name"
                                                               value="{{old('name', $item->name)}}"
                                                               class="form-control"
                                                               placeholder="Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" name="email"
                                                               value="{{old('email', $item->email)}}"
                                                               class="form-control"
                                                               placeholder="Email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Password</label>
                                                        <input type="text" name="password"
                                                               value="{{old('password')}}"
                                                               class="form-control"
                                                               placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Update Category MODAL -->
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->name}} </td>
                                    <td>{{$item->phone}} </td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        @can('update user')
                                            <a class="btn btn-success btn-sm" data-bs-target="#editProduct{{$item->id}}"
                                               data-bs-toggle="modal"
                                               href="javascript:void(0)"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete user')
                                            <a class="btn btn-danger btn-sm"
                                               data-bs-target="#deleteCategory{{$item->id}}"
                                               data-bs-toggle="modal"
                                               href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
                                </tr>

                                <!-- Delete Category MODAL -->
                                <div class="modal fade" id="deleteCategory{{$item->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Delete User</h6>
                                                <button aria-label="Close" class="btn-close"
                                                        data-bs-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                Are You Sure Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{route('admin.delete_user', $item->id)}}"
                                                   class="btn btn-primary">Delete</a>
                                                <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Slider MODAL -->
    <div class="modal fade" id="addProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Create New User</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.user_save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Name </label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control"
                                   placeholder="name " required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone </label>
                            <input type="number" name="phone" value="{{old('phone')}}" class="form-control"
                                   placeholder="Phone " required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email </label>
                            <input type="text" name="email" value="{{old('email')}}" class="form-control"
                                   placeholder="email " required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Password </label>
                            <textarea type="text" name="password" value="" class="form-control"
                                      placeholder="password " required> {{old('password')}} </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
