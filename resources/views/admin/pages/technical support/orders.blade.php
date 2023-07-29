@extends('admin.layouts.master')
@section('title', 'Orders')
@section('main-header', 'Orders')
@section('header', 'Technical Support')
@section('title_header', 'Orders')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                </div>
                <form action="{{route('admin.technical_support.search_orders')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Order Id</label>
                            <input type="number" name="order_id" class="form-control" required placeholder="Order Id">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
        @if(isset($order))
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-bordered text-nowrap border-bottom text-center"
                                   id="basic-datatable">
                                <thead>
                                <tr>
                                    <th class="">Order id</th>
                                    <th class="">Status</th>
                                    <th class="">Date</th>
                                    <th class="">User</th>
                                    <th class="">product</th>
                                    <th class="">More</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>

                                        @if ($order->status == '0')
                                            <span
                                                class="rounded-pill py-2 px-4 bg-warning-transparent text-warning d-inline-block">Processing</span>
                                        @elseif($order->status == '1')
                                            <span
                                                class="rounded-pill py-2 px-4 bg-primary-transparent text-primary d-inline-block">Receive</span>
                                        @elseif($order->status == '2')
                                            <span
                                                class="rounded-pill py-2 px-4 bg-info-transparent text-info d-inline-block">Receive
                                                        Complete</span>
                                        @elseif($order->status == '3')
                                            <span
                                                class="rounded-pill py-2 px-4 bg-secondary-transparent text-secondary d-inline-block">Delivery</span>
                                        @elseif($order->status == '4')
                                            <span
                                                class="rounded-pill py-2 px-4 bg-success-transparent text-success d-inline-block">Complete</span>
                                        @endif
                                    </td>
                                    @if ($order->created_at)
                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>
                                        @can('order show user')
                                            <a href="{{ route('admin.order.showUser', $order->user_id) }}"
                                               class="btn btn-sm btn-info">Show</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('order show product')
                                            <a href="{{ route('admin.order.showProduct', $order->product_id) }}"
                                               class="btn btn-sm btn-info">Show</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('order show product')
                                            <a href="{{ route('admin.order.more', $order->id) }}"
                                               class="btn btn-sm btn-primary">More</a>
                                        @endcan
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
    <script type="text/javascript">
        $(function () {
            $("#btn_send_all").click(function () {
                var selected = new Array();
                $(".datatable input[type=checkbox]:checked").each(function () {
                    selected.push(this.value);
                });
                console.log(selected.length);
                if (selected.length <= 0) {
                    $('#delete_all').modal('show')
                } else {
                    $('input[id="inputSelected"]').val(selected);
                }
            });
        });
    </script>
    <script>
        // get the header checkbox and all the checkboxes in the table body
        const headerCheckbox = document.querySelector('.headerCheckbox');
        const checkboxes = document.querySelectorAll('.checkboxes');

        // add an event listener to the header checkbox
        headerCheckbox.addEventListener('click', () => {
            checkboxes.forEach(checkbox => {
                checkbox.checked = headerCheckbox.checked;
            });
        });
    </script>
@endsection
