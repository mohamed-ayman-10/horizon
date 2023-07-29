@extends('admin.layouts.master')
@section('title', 'Orders')
@section('main-header', 'Orders')
@section('header', 'Orders')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @can('shipping')
                            <table class="table table-bordered text-center text-nowrap border-bottom" id="basic-datatable">
                                <thead>
                                    <tr>
                                        <th class="">#</th>
                                        <th class="">Date</th>
                                        <th class="">User</th>
                                        <th class="">product</th>
                                        <th class="">More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sendOrders as $index => $sendOrder)
                                        @if ($sendOrder->status == 0)
                                            <tr>
                                                <td colspan="10">
                                                    <div class="d-flex gap-5 align-items-center mx-auto"
                                                        style="width: fit-content">
                                                        <span>New Request</span>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <button type="submit" form="formSuccess"
                                                                class="btn btn-sm btn-success">
                                                                <i class="fe fe-check"></i>
                                                            </button>
                                                            <button type="submit" form="formUnSuccess"
                                                                class="btn btn-sm btn-danger">
                                                                <i class="fe fe-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <form id="formSuccess" action="{{ route('admin.order.statusSendOrder') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="1" form="formSuccess">
                                                        <input type="hidden" name="order_id" value="{{ $sendOrder->order_id }}"
                                                            form="formSuccess">
                                                    </form>
                                                    <form id="formUnSuccess" action="{{ route('admin.order.statusSendOrder') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="0"
                                                            form="formUnSuccess">
                                                        <input type="hidden" name="order_id" value="{{ $sendOrder->order_id }}"
                                                            form="formUnSuccess">
                                                    </form>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $sendOrder->order->created_at->diffForHumans() }}</td>
                                                <td>
                                                    @can('order show user')
                                                        <a href="{{ route('admin.order.showUser', $sendOrder->order->user_id) }}"
                                                            class="btn btn-sm btn-info">Show</a>
                                                    @endcan
                                                </td>
                                                <td>
                                                    @can('order show product')
                                                        <a href="{{ route('admin.order.showProduct', $sendOrder->order->product_id) }}"
                                                            class="btn btn-sm btn-info">Show</a>
                                                    @endcan
                                                </td>
                                                <td>
                                                    @can('order show product')
                                                        <a href="{{ route('admin.order.more', $sendOrder->order->id) }}"
                                                            class="btn btn-sm btn-primary">More</a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endcan
                        @can('order table')
                            <table class="table table-bordered text-center text-nowrap border-bottom" id="basic-datatable">
                                <thead>
                                    <tr>
                                        <th class="">#</th>
                                        <th class="">Order id</th>
                                        <th class="">Status</th>
                                        <th class="">Date</th>
                                        <th class="">User</th>
                                        <th class="">product</th>
                                        <th class="">More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->id }}</td>
                                            <td>

                                                @if ($item->status == '0')
                                                    <span
                                                        class="rounded-pill py-2 px-4 bg-warning-transparent text-warning d-inline-block">Processing</span>
                                                @elseif($item->status == '1')
                                                    <span
                                                        class="rounded-pill py-2 px-4 bg-primary-transparent text-primary d-inline-block">Receive</span>
                                                @elseif($item->status == '2')
                                                    <span
                                                        class="rounded-pill py-2 px-4 bg-info-transparent text-info d-inline-block">Receive
                                                        Complete</span>
                                                @elseif($item->status == '3')
                                                    <span
                                                        class="rounded-pill py-2 px-4 bg-secondary-transparent text-secondary d-inline-block">Delivery</span>
                                                @elseif($item->status == '4')
                                                    <span
                                                        class="rounded-pill py-2 px-4 bg-success-transparent text-success d-inline-block">Complete</span>
                                                @endif


                                                {{-- @if ($item->status == 1)
                                                    <span
                                                        class="rounded-pill py-2 px-4 bg-primary-transparent text-primary d-inline-block">Shipping</span>
                                                @elseif($item->status == 2)
                                                    <span
                                                        class="rounded-pill py-2 px-4 bg-success-transparent text-success d-inline-block">Complete</span>
                                                @else
                                                    <span
                                                        class="rounded-pill py-2 px-4 bg-warning-transparent text-warning d-inline-block">Processing</span>
                                                @endif --}}
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
        </div>
    </div>
@endsection

@section('scripts')
    <!-- DATA TABLE JS-->
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="../assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
    <script src="../assets/js/table-data.js"></script>
@endsection
