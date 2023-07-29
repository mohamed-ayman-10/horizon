@extends('admin.layouts.master')
@section('title', 'Edite Home ')
@section('main-header', 'Home')
@section('header', 'Edite Home')
@section('content')
    <form action="{{route('admin.update_home')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Address</label>
                <input type="text" name="address" value="{{old('address',$iteme->address)}}" class="form-control"
                       placeholder="Address" required>
            </div>
            <div class="form-group">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" value="{{old('phone',$iteme->phone)}}" class="form-control"
                       placeholder="Phone" required>
            </div>
            <div class="form-group">
                <label class="form-label">Facebook</label>
                <input type="text" name="facebook" value="{{old('facebook',$iteme->facebook)}}" class="form-control"
                       placeholder="Facebook" required>
            </div>
            <div class="form-group">
                <label class="form-label">Instagram</label>
                <input type="text" name="instagram" value="{{old('instagram',$iteme->instagram)}}" class="form-control"
                       placeholder="Instagram" required>
            </div>
            <div class="form-group">
                <label class="form-label">Whatsapp</label>
                <input type="text" name="whatsapp" value="{{old('whatsapp',$iteme->whatsapp)}}" class="form-control"
                       placeholder="Whatsapp" required>
            </div>

            <div class="form-group">
                <label class="form-label">Logo</label>
                <input type="file" name="logo" multiple accept="image/*"
                       class="form-control form-control-lg"
                       placeholder="Logo" >
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>


@endsection
