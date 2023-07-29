@extends('vendor.layouts.master')
@section('title', 'Images')
@section('main-header', 'Images')
@section('header', 'Product')
@section('title_header', 'Images')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" data-bs-target="#addImage" data-bs-toggle="modal"
                       href="javascript:void(0)">Add New Image</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom text-center" id="basic-datatable">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">Image</th>
                                <th class="wd-20p border-bottom-0">Create At</th>
                                <th class="wd-20p border-bottom-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $index=>$item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>
                                        <img src="{{asset('assets/' . $item->path)}}" width="100" height="100"/>
                                    </td>
                                    <td>{{$item->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a class="btn btn-success btn-sm" data-bs-target="#editImage{{$item->id}}"
                                           data-bs-toggle="modal"
                                           href="javascript:void(0)"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-danger btn-sm" data-bs-target="#deleteImage{{$item->id}}"
                                           data-bs-toggle="modal"
                                           href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <!-- Update Category MODAL -->
                                <div class="modal fade" id="editImage{{$item->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Edit Product</h6>
                                                <button aria-label="Close" class="btn-close"
                                                        data-bs-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{route('vendor.product.updateImage', $item->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="form-label">Image</label>
                                                        <input type="file" accept="image/*" name="image"
                                                               class="form-control form-control-lg" required>
                                                    </div>
                                                    <img src="{{asset('images/' . $item->path)}}" width="100"
                                                         height="100"/>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Category MODAL -->
                                <div class="modal fade" id="deleteImage{{$item->id}}">
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
                                                <a href="{{route('vendor.product.destroyImage', $item->id)}}"
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
    <!-- Create Product MODAL -->
    <div class="modal fade" id="addImage">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Create New Product</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('vendor.product.storeImages')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="product_id" value="{{$id}}">
                            <label class="form-label">Images</label>
                            <input type="file" name="images[]" multiple accept="image/*"
                                   class="form-control form-control-lg"
                                   placeholder="Images" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
