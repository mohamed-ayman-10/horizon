@extends('admin.layouts.master')
@section('title', 'Product')
@section('main-header', 'Product')
@section('header', 'Orders')
@section('title_header', 'Product')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card_title">Product details</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap border-bottom" id="basic-datatable">
                            <tr>
                                <td class="w-25">Title</td>
                                <td>{{$product->title}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Expiry date</td>
                                <td>{{$product->end_date}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Quantity</td>
                                <td>{{$product->quantity}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Price</td>
                                @if($product->total_price)
                                    <td>{{$product->total_price}}</td>
                                @else
                                    <td>{{$product->price}}</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="w-25">Category</td>
                                <td>{{$product->category->title}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Vendor</td>
                                <td>{{$product->vendor->name}}</td>
                            </tr>
                            @foreach($product->images as $image)
                                <tr>
                                    <td class="w-25">Image</td>
                                    <td><img src="{{asset('assets/' . $image->path)}}" width="200"/></td>
                                </tr>
                            @endforeach
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
