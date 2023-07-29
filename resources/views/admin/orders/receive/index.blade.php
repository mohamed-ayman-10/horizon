@extends('admin.layouts.master')
@section('title', 'Receives')
@section('main-header', 'Receives')
@section('header', 'Orders')
@section('title_header', 'Receives')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="panel panel-primary">
                <div class="tab-menu-heading tab-menu-heading-boxed">
                    <div class="tabs-menu tabs-menu-border">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li>
                                <a href="#tab1" class="active" data-bs-toggle="tab">Receives</a>
                            </li>
                            <li>
                                <a href="#tab2" data-bs-toggle="tab">Requests</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-nowrap border-bottom"
                                    id="basic-datatable">
                                    <thead>
                                        <th>#</th>
                                        <th>Order id</th>
                                        <th>Date</th>
                                        <th>Vendor</th>
                                        <th>Product</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($receive as $index => $receive)
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $receive->order_id }}</td>
                                            @if ($receive->order->created_at)
                                                <td>{{ $receive->order->created_at->diffForHumans() }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>
                                                <a href="{{ route('admin.order.showVendor', $receive->order->vendor_id) }}"
                                                    class="btn btn-sm btn-info">Show</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.order.showProduct', $receive->order->product_id) }}"
                                                    class="btn btn-sm btn-info">Show</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.order.more', $receive->order_id) }}"
                                                    class="btn btn-sm btn-primary">More</a>
                                                <a href="{{ route('admin.order.receive.complete', $receive->order_id) }}"
                                                    class="btn btn-sm btn-success">Complete</a>
                                            </td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            @forelse ($requestes as $index => $request)
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header mx-auto">
                                                <h4 class="card-title">New Request</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="mx-auto" style="width: fit-content">
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
                                                    <input type="hidden" name="order_id" value="{{ $request->order_id }}"
                                                        form="formSuccess">
                                                </form>
                                                <form id="formUnSuccess" action="{{ route('admin.order.statusSendOrder') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="0"
                                                        form="formUnSuccess">
                                                    <input type="hidden" name="order_id" value="{{ $request->order_id }}"
                                                        form="formUnSuccess">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-warning" role="alert">
                                    No Requestes
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/table-data.js') }}"></script>
    <!--- TABS JS -->
    <script src="{{ asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ asset('assets/plugins/tabs/tab-content.js') }}"></script>
@endsection
