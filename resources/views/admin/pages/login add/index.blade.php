@extends('admin.layouts.master')
@section('title', 'Login Ads')
@section('main-header', 'Login Ads')
@section('title_header', 'Login Ads')
@section('header', 'Ads')
@section('content')
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">Create
            </button>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($data as $item)
                    <div class="col-md-4 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <img src="{{asset($item->image)}}" alt="" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-success w-100 mb-1" data-bs-toggle="modal" data-bs-target="#update{{$item->id}}">Update</button>
                                <button type="button" class="btn btn-danger w-100 mb-1" data-bs-toggle="modal" data-bs-target="#delete{{$item->id}}">Delete</button>
                            </div>
                        </div>
                    </div>
                    {{-- Update --}}
                    <div class="modal fade" id="update{{$item->id}}">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Update</h6>
                                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{ route('admin.ads.login.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Image <span class="text-danger">*</span>
                                                <input type="file" name="image" class="form-control">
                                            </label>
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
                    {{-- Delete --}}
                    <div class="modal fade" id="delete{{$item->id}}">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Update</h6>
                                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{ route('admin.ads.login.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        <div class="alert alert-danger" role="alert">Are You Sure Delete!</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning text-center" role="alert">No Ads</div>
                @endforelse
            </div>
        </div>
    </div>
    {{-- Create --}}
    <div class="modal fade" id="create">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Create</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('admin.ads.login.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">
                                Image <span class="text-danger">*</span>
                                <input type="file" name="image" class="form-control">
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
