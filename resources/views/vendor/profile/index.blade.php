@extends('vendor.layouts.master')
@section('title', 'Vendor')
@section('main-header', 'View Vendor')
@section('header', 'Vendor')
@section('content')

    <!-- PAGE -->
    <div class="page w-100 ">
        <div class="page-main">
            <!--app-content open-->
            <div style=" margin-left: 0;" class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- ROW-1 OPEN -->
                        <div class="row">
                            {{--                            <div class="col-xl-6">--}}
                            <form method="POST" action="{{route('vendor.update_vendor')}}">
                                @csrf
                                <div class="w-50 m-auto card">
                                    <div class="card-header">
                                        <div class="card-title">Edit Password</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center chat-image mb-5">
                                            <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                                <a class="" href="profile.html"><img alt="avatar"
                                                                                     src="{{asset('assets')}}/../assets/images/users/7.jpg"
                                                                                     class="brround"></a>
                                            </div>
                                            <div class="main-chat-msg-name">
                                                <a href="profile.html">
                                                    <h5 class="mb-1 text-dark fw-semibold">{{$vendor->name}}</h5>
                                                </a>
                                                <p class="text-muted mt-0 mb-0 pt-0 fs-13">Web Designer</p>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">New Password</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                                <a href="javascript:void(0)"
                                                   class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 form-control" type="password" name="password"
                                                       placeholder="New Password" autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Confirm Password</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                                <a href="javascript:void(0)"
                                                   class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 form-control" type="password"
                                                       name="password_confirmation" placeholder="Confirm Password"
                                                       autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                                <input class="input100 form-control" value="{{$vendor->email}}"
                                                       name="email" type="email" placeholder="Email"
                                                       autocomplete="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                                <input class="input100 form-control" value="{{$vendor->name}}"
                                                       type="text" name="name" placeholder="Email" autocomplete="Email">
                                                <input class="input100 form-control" value="{{$vendor->id}}"
                                                       type="hidden" name="vendor_id" placeholder="Email"
                                                       autocomplete="Email">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                                <input class="input100 form-control" value="{{$vendor->phone}}"
                                                       type="text" name="Phone" placeholder="Phone" autocomplete="Phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <input class="btn btn-primary" value="Update" type="submit"
                                               autocomplete="Email">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--CONTAINER CLOSED -->
            </div>
        </div>
        <!--app-content open-->
    </div>


    </div>

@endsection
