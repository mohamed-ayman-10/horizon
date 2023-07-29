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
                    <h3 class="card-title">Vendor Messages</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom text-center" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Message</th>
                                    <th class="wd-20p border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            <div class="">
                                                <a class="btn btn-primary" href="javascript:void(0)"
                                                    data-bs-target="#editImage{{ $item->id }}" data-bs-toggle="modal"><i
                                                        class="fe fe-edit"></i></a>
                                                <a class="btn btn-danger" href="javascript:void(0)"
                                                    data-bs-target="#deleteImage{{ $item->id }}"
                                                    data-bs-toggle="modal"><i class="fe fe-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Create Message MODAL -->
                                    <div class="modal fade" id="add{{ $item->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Send Messages</h6>
                                                    <button aria-label="Close" class="btn-close"
                                                        data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('admin.vendorMessage.store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="vendor_ids[]" value="{{ $item->id }}">
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

                                    <!-- Update Message MODAL -->
                                    <div class="modal fade" id="editImage{{ $item->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Edit Product</h6>
                                                    <button aria-label="Close" class="btn-close"
                                                        data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('admin.vendorMessage.update') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="form-label">Message</label>
                                                            <textarea name="message" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                        <a class="btn btn-light" data-bs-dismiss="modal">Close</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Category MODAL -->
                                    <div class="modal fade" id="deleteImage{{ $item->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Delete Image</h6>
                                                    <button aria-label="Close" class="btn-close"
                                                        data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are You Sure Delete?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ route('admin.vendorMessage.destroy', $item->id) }}"
                                                        class="btn btn-primary">Delete</a>
                                                    <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                </div>
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
