@extends('admin.layouts.master')
@section('title', 'Admin Category')
@section('main-header', 'Admin Category')
@section('header', 'Admin Category')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <button data-bs-target="#send_all" data-bs-toggle="modal" type="button"
                        class="btn modal-effect ripple btn-primary" id="btn_send_all">
                        Create
                    </button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table table-bordered text-nowrap border-bottom text-center"
                            id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Title</th>
                                    <th class="wd-15p border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            <div class="">
                                                <a class="btn btn-success" href="javascript:void(0)"
                                                    data-bs-target="#add{{ $item->id }}" data-bs-toggle="modal"><i
                                                        class="fe fe-edit"></i></a>
                                                <a class="btn btn-danger" href="javascript:void(0)"
                                                   data-bs-target="#delete{{ $item->id }}" data-bs-toggle="modal"><i
                                                        class="fe fe-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Update MODAL -->
                                    <div class="modal fade" id="add{{ $item->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Update Category</h6>
                                                    <button aria-label="Close" class="btn-close"
                                                        data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('admin.name_category.update', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" name="title" value="{{old('title', $item->title)}}" class="form-control" required placeholder="Title">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                        <a class="btn btn-light" data-bs-dismiss="modal">Close</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete MODAL -->
                                    <div class="modal fade" id="delete{{ $item->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Delete Category</h6>
                                                    <button aria-label="Close" class="btn-close"
                                                            data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('admin.name_category.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-body">
                                                        <div class="alert alert-danger" role="alert">
                                                           Are You Sure Delete?
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Delete</button>
                                                        <a class="btn btn-light" data-bs-dismiss="modal">Close</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Create MODAL -->
    <div class="modal fade" id="send_all">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Create Category</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('admin.name_category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required placeholder="Title">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <a class="btn btn-light" data-bs-dismiss="modal">Close</a>
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
    <script type="text/javascript">
        $(function() {
            $("#btn_send_all").click(function() {
                var selected = new Array();
                $(".datatable input[type=checkbox]:checked").each(function() {
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
