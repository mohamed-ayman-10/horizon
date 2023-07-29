<style>
    .notivicationCount {
        width: 15px;
        height: 15px;
        font-size: 10px;
    }
</style>

<div
    class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
               href="javascript:void(0)"></a>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal " href="index.html">
                <img src="{{asset('assets')}}/images/brand/logo-white.png" class="header-brand-img desktop-logo"
                     alt="logo">
                <img src="{{asset('assets')}}/images/brand/logo-dark.png" class="header-brand-img light-logo1"
                     alt="logo">
            </a>
            <!-- LOGO -->
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <div class="d-flex">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                    <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                    <span class="light-layout"><i class="fe fe-sun"></i></span>
                                </a>
                            </div>
                            <!-- Theme-Layout -->
                            <div class="dropdown  d-flex notifications">
                                <a class="nav-link icon" data-bs-toggle="dropdown"><i

                                        class="fe fe-bell"></i>
                                    @if(auth('admin')->user()->unreadNotifications->count() > 0)
                                        <span
                                            class="badge bg-danger header-badge">{{auth('admin')->user()->unreadNotifications->count()}}</span>
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading border-bottom">
                                        <div class="d-flex">
                                            <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications
                                            </h6>
                                            <div class="ms-auto">
                                                <a href="{{route('admin.markAllAsRead')}}" class="text-muted p-0 fs-12">Mark
                                                    all as read</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="notifications-menu">
                                        @foreach(auth('admin')->user()->unreadNotifications as $notification)
                                            <button type="submit" form="form{{$notification->id}}"
                                                    class="dropdown-item d-flex" href="notify-list.html">
                                                <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                    <i class="fe fe-image"></i>
                                                </div>
                                                <div class="mt-1 wd-80p">
                                                    @if(array_key_exists('vendor_id', $notification->data))
                                                        <h5 class="notification-label mb-1">
                                                            Please pay the amounts due to the merchant
                                                            <a class="p-0" href="">
                                                                {{\App\Models\Vendor::query()->where('id', $notification->data['vendor_id'])->pluck('name')[0]}}
                                                            </a>
                                                        </h5>
                                                    @elseif(array_key_exists('admin_id', $notification->data))
                                                        @if($notification->data['status'] == 1)
                                                            <h5 class="notification-label mb-1">
                                                                The request was received by
                                                                <a class="p-0" href="">
                                                                    {{\App\Models\Admin::query()->where('id', $notification->data['admin_id'])->pluck('name')[0]}}
                                                                </a>
                                                            </h5>
                                                        @elseif($notification->data['status'] == 0))
                                                        <h5 class="notification-label mb-1">
                                                            The request was rejected by
                                                            <a class="p-0" href="">
                                                                {{\App\Models\Admin::query()->where('id', $notification->data['admin_id'])->pluck('name')[0]}}
                                                            </a>
                                                        </h5>
                                                        @endif
                                                    @endif
                                                    <div class="d-flex justify-content-between">
                                                        <span
                                                            class="notification-subtext">{{$notification->created_at->diffForHumans()}}</span>
                                                        <a href="{{route('admin.deleteNotification', $notification->id)}}"
                                                           class="p-0 text-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </button>

                                            <form
                                                action="{{route('admin.redNotifications', $notification->id)}}"
                                                method="post" id="form{{$notification->id}}">
                                                @csrf
                                            </form>
                                        @endforeach
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="{{route('admin.notifications')}}"
                                       class="dropdown-item text-center p-3 text-muted">View all
                                        Notification</a>
                                </div>
                            </div>
                            <!-- NOTIFICATIONS -->
                            <div class="dropdown d-flex">
                                <a class="nav-link icon full-screen-link nav-link-bg">
                                    <i class="fe fe-minimize fullscreen-button"></i>
                                </a>
                            </div>
                            <!-- FULL-SCREEN -->
                            <div class="dropdown d-flex profile-1">
                                <a href="javascript:void(0)" data-bs-toggle="dropdown"
                                   class="nav-link leading-none d-flex">
                                    <img src="{{asset('assets')}}/images/users/21.jpg" alt="profile-user"
                                         class="avatar  profile-user brround cover-image">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold">{{auth('admin')->user()->name}}</h5>
                                            @foreach(auth('admin')->user()->role_name as $role)
                                                <small class="text-muted">{{$role}}</small>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item" href="{{route('admin.show_profile',auth('admin')->user()->id)}}">
                                        <i class="dropdown-icon fe fe-user"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="{{route('admin.logout')}}">
                                        <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
