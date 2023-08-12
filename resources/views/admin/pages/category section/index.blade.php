@extends('admin.layouts.master')
@section('title', 'Category Section')
@section('main-header', 'Category Section')
@section('header', 'Category')
@section('title_header', 'Category Section')
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
                                <th>#</th>
                                <th>title</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($section as $index=>$item)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->category->title}}</td>
                                    <td>
                                        <a href="{{route('admin.category_section.products', $item->id)}}" class="btn btn-warning">
                                            <i class="fe fe-eye"></i>
                                        </a>
                                        <a data-bs-target="#update{{$item->id}}" data-bs-toggle="modal"
                                           href="javascript:;" class="btn btn-success">
                                            <i class="fe fe-edit"></i>
                                        </a>
                                        <a data-bs-target="#delete{{$item->id}}" data-bs-toggle="modal"
                                           href="javascript:;" class="btn btn-danger">
                                            <i class="fe fe-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Update Section MODAL -->
                                <div class="modal fade" id="update{{$item->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Add New Section</h6>
                                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="{{route('admin.category_section.update', $item->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="title"
                                                               value="{{old('title', $item->title)}}"
                                                               class="form-control" required placeholder="Title">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-success" type="submit">Save changes
                                                    </button>
                                                    <button class="btn ripple btn-danger" data-bs-dismiss="modal"
                                                            type="button">Close
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Section MODAL -->
                                <div class="modal fade" id="delete{{$item->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Delete Section</h6>
                                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="{{route('admin.category_section.destroy', $item->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body">
                                                    <div class="alert alert-danger" role="alert">Are You Sure Delete!?</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-success" type="submit">Save changes
                                                    </button>
                                                    <button class="btn ripple btn-danger" data-bs-dismiss="modal"
                                                            type="button">Close
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <td colspan="100" class="bg-danger-transparent text-danger">
                                    No Data
                                </td>
                            @endforelse
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
                <form action="{{route('admin.category_section.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="category_id" value="{{$id}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required placeholder="Title">
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
