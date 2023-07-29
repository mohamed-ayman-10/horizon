@extends('admin.layouts.master')
@section('title', 'Notifications')
@section('main-header', 'Notifications')
@section('header', 'Notifications')
@section('content')
    <!-- Container -->
    <div class="container">
        <ul class="notification">
            @foreach(auth()->user('admin')->unreadNotifications as $notification)
                <li>
                    <div class="notification-time">
                        <span class="date">{{date('l', strtotime($notification->created_at))}}</span>
                        <span class="time">{{date('H:i', strtotime($notification->created_at))}}</span>
                    </div>
                    <div class="notification-icon">
                        <a href="javascript:void(0);"></a>
                    </div>
                    <div class="notification-time-date mb-2 d-block d-md-none">
                        <span class="date">{{date('l', strtotime($notification->created_at))}}</span>
                        <span class="time ms-2">{{date('H:i', strtotime($notification->created_at))}}</span>
                    </div>
                    <div class="notification-body">
                        <div class="media mt-0">
                            <button type="submit" form="form{{$notification->id}}"
                                    class="dropdown-item d-flex" href="notify-list.html">
                                <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                    @if(\App\Models\Vendor::query()->where('id', $notification->data['vendor_id'])->pluck('image')[0])
                                        <img
                                            src="{{asset('images/' . \App\Models\Vendor::query()->where('id', $notification->data['vendor_id'])->pluck('image')[0])}}"
                                            alt="">
                                    @else
                                        <i class="fe fe-image"></i>
                                    @endif
                                </div>
                                <div class="mt-1 wd-80p">
                                    <h5 class="notification-label mb-1">
                                        Please pay the amounts due to the merchant <a class="p-0"
                                                                                      href="">{{\App\Models\Vendor::query()->where('id', $notification->data['vendor_id'])->pluck('name')[0]}}</a>

                                    </h5>
                                    <div class="d-flex justify-content-between">
                                        <span class="notification-subtext">{{$notification->created_at->diffForHumans()}}</span>
                                        <a href="{{route('admin.deleteNotification', $notification->id)}}" class="p-0 text-danger">Delete</a>
                                    </div>
                                </div>
                            </button>
                            <form
                                action="{{route('admin.redNotifications', $notification->id)}}"
                                method="post" id="form{{$notification->id}}">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- End Container -->
@endsection
