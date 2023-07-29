@extends('admin.layouts.master')
@section('title', 'Vendor Votifications')
@section('main-header', 'Vendor Votifications')
@section('header', 'Vendor Votifications')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <button data-bs-target="#send_all" data-bs-toggle="modal" type="button"
                        class="btn modal-effect ripple btn-success" id="btn_send_all">
                        Send All Selected
                    </button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table table-bordered text-nowrap border-bottom text-center"
                            id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <input class="headerCheckbox" name="select_all" id="example-select-all"
                                            type="checkbox" onclick="CheckAll('box1', this)" />
                                    </th>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-20p border-bottom-0">Email</th>
                                    <th class="wd-20p border-bottom-0">Phone</th>
                                    <th class="wd-20p border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendors as $index => $item)
                                    <tr>
                                        <td class="text-center"><input type="checkbox" class="checkboxes"
                                                value="{{ $item->id }}" class="box1"></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            <div class="">
                                                <a class="btn btn-primary" href="javascript:void(0)"
                                                    data-bs-target="#add{{ $item->id }}" data-bs-toggle="modal"><i
                                                        class="fe fe-send"></i></a>
                                                <a class="btn btn-warning"
                                                    href="{{ route('admin.vendorNotification.show', $item->id) }}"><i
                                                        class="fe fe-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Create Message MODAL -->
                                    <div class="modal fade" id="add{{ $item->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Send Notifications</h6>
                                                    <button aria-label="Close" class="btn-close"
                                                        data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('admin.vendorNotification.store') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="vendor_ids" value="{{ $item->id }}">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="form-label">Message</label>
                                                            <textarea name="message" class="form-control"></textarea>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Send Selected Message MODAL -->
    <div class="modal fade" id="send_all">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Send Notifications</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('admin.vendorNotification.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input id="inputSelected" type="hidden" name="vendor_ids" value="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control"></textarea>
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
