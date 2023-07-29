@extends('admin.layouts.master')
@section('title', 'User')
@section('main-header', 'User')
@section('header', 'Orders')
@section('title_header', 'User')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap border-bottom" id="basic-datatable">
                            <tr>
                                <td class="w-25">Name</td>
                                <td>{{$vendor->name}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Email</td>
                                <td>{{$vendor->email}}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Phone</td>
                                <td>{{$vendor->phone}}</td>
                            </tr>
                            @if($vendor->image)
                                <tr>
                                    <td class="w-25">Image</td>
                                    <td><img src="{{asset('images/' . $vendor->image)}}" width="200" /></td>
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
