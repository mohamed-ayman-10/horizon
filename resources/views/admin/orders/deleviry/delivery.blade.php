@extends('admin.layouts.master')
@section('title', 'Delivery')
@section('main-header', 'Delivery')
@section('header', 'Orders')
@section('title_header', 'Delivery')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Delivery</h3>
        </div>

        <form action="{{ route('admin.order.postDelivery') }}" method="post">
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label class="form-label">Select Orders</label>
                    <select multiple="multiple" name="order_ids[]" class="filter-multi">
                        @foreach ($orders as $order)
                            <option value="{{ $order->id }}">{{ $order->id }} -
                                {{ $order->first_name . ' ' . $order->last_name . ' - ' . $order->governorate->title . ' - ' . '$' . $order->total_price . ' - ' . $order->user->phone }}
                                - {{ $order->product->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label"> Select Admin</label>
                    <select name="admin_id" class="form-control select2-show-search form-select"
                        data-placeholder="Choose Admin">
                        <option selected disabled>Choose Admin</option>
                        @foreach ($admins as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div>

    <div class="card mt-5">
        <div class="card-header">
            <h3 class="card-title">Deleviry Orders</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @can('order table')
                    <table class="table table-bordered text-center text-nowrap border-bottom" id="basic-datatable">
                        <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="">Order id</th>
                                <th>Deleviry</th>
                                <th class="">Date</th>
                                <th class="">User</th>
                                <th class="">product</th>
                                <th class="">More</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($delivery as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.admins.edit', $item->sendOrder->admin_id) }}">{{ $item->sendOrder->admin->name }}</a>
                                    </td>
                                    @if ($item->created_at)
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>
                                        @can('order show user')
                                            <a href="{{ route('admin.order.showUser', $item->user_id) }}"
                                                class="btn btn-sm btn-info">Show</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('order show product')
                                            <a href="{{ route('admin.order.showProduct', $item->product_id) }}"
                                                class="btn btn-sm btn-info">Show</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('order show product')
                                            <a href="{{ route('admin.order.more', $item->id) }}"
                                                class="btn btn-sm btn-primary">More</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endcan
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- DATA TABLE JS-->
    <script src="{{ asset('/') }}assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/js/table-data.js"></script>
    <!-- SELECT2 JS -->
    <script src="{{ asset('/') }}assets/plugins/select2/select2.full.min.js"></script>
    <script src="{{ asset('/') }}assets/js/select2.js"></script>
    <!-- MULTI SELECT JS-->
    <script src="{{ asset('/') }}assets/plugins/multipleselect/multiple-select.js"></script>
    <script src="{{ asset('/') }}assets/plugins/multipleselect/multi-select.js"></script>
@endsection
