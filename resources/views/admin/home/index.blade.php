@extends('admin.layouts.master')
@section('title', 'Setting ')
@section('main-header', 'Setting')
@section('header', 'Setting')
@section('content')
    <div class="card">
        <div class="card-header">
            @if($item)
                <a data-bs-toggle="modal" data-bs-target="#update" class="btn btn-info">Update</a>
            @else
                <a data-bs-toggle="modal" data-bs-target="#create" class="btn btn-primary">Create</a>
            @endif
        </div>
        <div class="card-body">
            @if($item)
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td class="w-25">Title</td>
                        <td class="w-75">{{$item->title}}</td>
                    </tr>
                    <tr>
                        <td class="w-25">Address</td>
                        <td class="w-75">{{$item->address}}</td>
                    </tr>
                    <tr>
                        <td class="w-25">Phone</td>
                        <td class="w-75">{{$item->phone}}</td>
                    </tr>
                    <tr>
                        <td class="w-25">Facebook</td>
                        <td class="w-75">{{$item->facebook}}</td>
                    </tr>
                    <tr>
                        <td class="w-25">Instagram</td>
                        <td class="w-75">{{$item->instagram}}</td>
                    </tr>
                    <tr>
                        <td class="w-25">Logo</td>
                        <td class="w-75">
                            <img src="{{asset($item->logo)}}" alt="{{$item->title}}" width="150" height="150">
                        </td>
                    </tr>
                    </thead>
                </table>
                {{-- Create Setting --}}
                <div class="modal fade" id="create">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">Create Setting</h6>
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{ route('admin.setting.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" value="{{old('address')}}" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="number" name="phone" class="form-control" value="{{old('phone')}}" placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Facebook</label>
                                        <input type="url" name="facebook" class="form-control" value="{{old('facebook')}}" placeholder="Facebook">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Instagram</label>
                                        <input type="url" name="instagram" class="form-control" value="{{old('instagram')}}" placeholder="Instagram">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Logo</label>
                                        <input type="file" name="logo" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Update Setting --}}
                <div class="modal fade" id="update">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">Update Setting</h6>
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{ route('admin.setting.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" value="{{old('title', $item->title)}}" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" value="{{old('address', $item->address)}}" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="number" name="phone" class="form-control" value="{{old('phone', $item->phone)}}" placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Facebook</label>
                                        <input type="url" name="facebook" class="form-control" value="{{old('facebook', $item->facebook)}}" placeholder="Facebook">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Instagram</label>
                                        <input type="url" name="instagram" class="form-control" value="{{old('instagram', $item->instagram)}}" placeholder="Instagram">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Logo</label>
                                        <input type="file" name="logo" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-danger" role="alert">No Setting</div>
            @endif
        </div>
    </div>
@endsection
