@extends('admin.layouts.master')
@section('title', 'All product')
@section('main-header', 'All product')
@section('header', 'Sections')
@section('title_header', 'All product')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" data-bs-target="#select2modal" data-bs-toggle="modal" href="javascript:;"
                       href="javascript:void(0)">Add New Section</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom text-center" id="basic-datatable">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">Title</th>
                                <th class="wd-15p border-bottom-0">Order</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sections as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->order}}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger" title="Delete" data-bs-toggle="modal"
                                           data-bs-target="#deleteImage{{ $item->id }}""
                                        href="javascript:void(0)">
                                        <i class="fe fe-trash"></i>
                                        </a>
                                        <a class="btn btn-primary" href="{{route('admin.product_section.show', $item->id)}}"><i class="fe fe-eye"></i></a>
                                    </td>
                                    <!-- Delete Category MODAL -->
                                    <div class="modal fade" id="deleteImage{{ $item->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Delete Section</h6>
                                                    <button aria-label="Close" class="btn-close"
                                                            data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are You Sure Delete?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{route('admin.product_section.destroy', $item->id)}}" id="formDelete{{$item->id}}" method="post">@csrf @method("DELETE")</form>
                                                    <button type="submit" form="formDelete{{$item->id}}"
                                                       class="btn btn-primary">Delete</button>
                                                    <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Section MODAL -->
    <div class="modal fade" id="select2modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add New Section</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{route('admin.product_section.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Order</label>
                            <input type="number" name="order" class="form-control" required placeholder="Order">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit">Save changes</button>
                        <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
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
