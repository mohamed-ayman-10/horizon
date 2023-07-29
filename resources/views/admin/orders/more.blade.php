@extends('admin.layouts.master')
@section('title', 'More')
@section('main-header', 'More')
@section('header', 'Orders')
@section('title_header', 'More')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap border-bottom" id="basic-datatable">
                            <tr>
                                <td class="w-25">First Name</td>
                                <td>{{$order->first_name}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Last Name</td>
                                <td>{{$order->last_name}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Governotare</td>
                                <td class="w-25">{{$order->governorate->title}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Date</td>
                                <td class="w-25">{{$order->date}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Email</td>
                                <td>{{$order->email}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Phone</td>
                                <td>{{$order->phone}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">City</td>
                                <td>{{$order->city}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Apartment</td>
                                <td>{{$order->apartment}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Floor</td>
                                <td>{{$order->floor}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Street</td>
                                <td>{{$order->street}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Building</td>
                                <td>{{$order->building}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Wallet Number</td>
                                <td>{{$order->wallet_number}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Payment Method</td>
                                <td>
                                    {{$order->payment_method == 0 ? 'Cash On Delivery' : 'Vodafone Cash'}}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-25">Price</td>
                                <td>{{$order->total_price}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Notes</td>
                                <td>{{$order->notes}}</td>
                            </tr>
                            @if($order->image)
                                <tr>
                                    <td class="w-25">Image</td>
                                    <td><img src="{{asset('images/' . $order->image)}}" width="200"/></td>
                                </tr>
                            @endif
                        </table>
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
