<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1 side-menu__item has-link" href="{{ route('admin.index') }}">
                <h2 class="header-brand-img desktop-logo">Horizon</h2>
                <h2 class="header-brand-img toggle-logo">H</h2>
                {{--                <img src="{{asset('assets')}}/images/brand/logo-white.png" class="header-brand-img desktop-logo" --}}
                {{--                     alt="logo"> --}}
                {{--                <img src="{{asset('assets')}}/images/brand/icon-white.png" class="header-brand-img toggle-logo" --}}
                {{--                     alt="logo"> --}}
                {{--                <img src="{{asset('assets')}}/images/brand/icon-dark.png" class="header-brand-img light-logo" --}}
                {{--                     alt="logo"> --}}
                {{--                <img src="{{asset('assets')}}/images/brand/logo-dark.png" class="header-brand-img light-logo1" --}}
                {{--                     alt="logo"> --}}
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                     viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/>
                </svg>
            </div>
            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('vendor.index') }}"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
                </li>
                @can('admins')
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Admins</span><i
                                class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @can('list admins')
                                <li><a href="{{ route('admin.admins.index') }}" class="slide-item">Admins</a></li>
                            @endcan
                            @can('roles')
                                <li><a href="{{ route('admin.roles.index') }}" class="slide-item">Roles</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Products</span><i
                            class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.all_products') }}" class="slide-item">Products</a></li>
                        <li><a href="{{ route('admin.all_product_unsharing') }}" class="slide-item">Publish Product</a>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fa fa-user-circle-o"></i><span class="side-menu__label">Technical Support</span><i
                            class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.technical_support.vendors') }}" class="slide-item">Vendors</a></li>
                        <li><a href="{{ route('admin.technical_support.orders') }}" class="slide-item">Orders</a>
                        </li>
                    </ul>
                </li>
                @can('categories')
                    <li>
                        <a class="side-menu__item has-link" href="{{ route('admin.categories./') }}">
                            <i class="side-menu__icon fe fe-list"></i>
                            <span class="side-menu__label">categories </span>
                        </a>
                    </li>
                @endcan
                @can('vendors')
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                class="side-menu__icon fa fa-user-plus"></i><span
                                class="side-menu__label">Vendors</span><i
                                class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('admin.show_vendor') }}" class="slide-item">Vendors</a></li>
                            <li><a href="{{ route('admin.vendorNotification.index') }}" class="slide-item">Vendor
                                    Notifications</a></li>
                            <li><a href="{{ route('admin.vendorMessage.index') }}" class="slide-item">Vendor
                                    Messages</a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('users')
                    <li>
                        <a class="side-menu__item has-link" href="{{ route('admin.get_user') }}">
                            <i class="side-menu__icon fe fe-users"></i>
                            <span class="side-menu__label">Users </span>
                        </a>
                    </li>
                @endcan
                @can('orders')
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                class="side-menu__icon fa fa-shopping-bag"></i><span
                                class="side-menu__label">Orders</span><i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @can('order table')
                                <li><a href="{{ route('admin.order.index') }}" class="slide-item">Orders</a></li>
                            @endcan
                            @can('receive')
                                <li><a href="{{ route('admin.order.receive.index') }}" class="slide-item">Receives</a>
                                </li>
                            @endcan
                            @can('delivery')
                                <li><a href="{{ route('admin.order.delivery.index') }}" class="slide-item">Delivery</a>
                                </li>
                            @endcan
                            @can('send requests receive')
                                <li><a href="{{ route('admin.order.receive') }}" class="slide-item">Receives</a></li>
                            @endcan
                            @can('send requests delivery')
                                <li><a href="{{ route('admin.order.delivery') }}" class="slide-item">Delivery</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fa fa-object-ungroup"></i><span
                            class="side-menu__label">Sections</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('slider')
                            <li><a href="{{ route('admin.get_slider') }}" class="slide-item">Slider</a></li>
                            <li><a href="{{ route('admin.section.offer.index') }}" class="slide-item">Offers</a></li>
                            <li><a href="{{ route('admin.section.weeklyOffer.index') }}" class="slide-item">Weekly
                                    Offers</a></li>
                            <li><a href="{{ route('admin.section.fristCategory.index') }}" class="slide-item">First Category</a></li>
                            <li><a href="{{ route('admin.section.lastCategory.index') }}" class="slide-item">Last Category</a></li>
                            <li><a href="{{ route('admin.section.firstProduct.index') }}" class="slide-item">First Product</a></li>
                            <li><a href="{{ route('admin.section.lastProduct.index') }}" class="slide-item">Last Product</a></li>
                            <li><a href="{{ route('admin.product_section.index') }}" class="slide-item">All Product</a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('setting')
                    <li>
                        <a class="side-menu__item has-link" href="{{ route('admin.get_home') }}">
                            <i class="side-menu__icon fe fe-settings"></i>
                            <span class="side-menu__label">Settings</span>
                        </a>
                    </li>
                @endcan
            </ul>
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </div>
</div>
