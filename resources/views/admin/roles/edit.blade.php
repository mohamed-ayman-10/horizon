@extends('admin.layouts.master')
@section('title', 'Admins')
@section('main-header', 'Admins')
@section('header', 'Admins')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <form action="{{route('admin.roles.update', $role->id)}}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{old('name', $role->name)}}" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Permissions</label>
                    <hr>
                    <div class="d-flex flex-wrap gap-4">
                        @foreach($permissions as $permission)
                            <label class="form-label">
                                <input type="checkbox" name="permission[]" {{in_array($permission->id, $rolePermissions) ? 'checked' : ''}} value="{{$permission->id}}" class="">
                                {{$permission->name}} <span class="ms-4">|</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
