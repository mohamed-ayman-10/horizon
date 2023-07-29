@extends('admin.layouts.master')
@section('title', 'Vendor')
@section('main-header', 'Vendor')
@section('header', 'All Vendor')
@section('content')

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    @can('create vendor')
                        <a class="btn btn-primary" data-bs-target="#addProduct" data-bs-toggle="modal"
                           href="javascript:void(0)">Add New Vendor</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">Name</th>
                                <th class="wd-15p border-bottom-0">Email</th>
                                <th class="wd-20p border-bottom-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vendors as $index=>$item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        @can('update vendor')
                                            <a class="btn btn-success btn-sm"
                                               href="{{route('admin.get_vendor',$item->id)}}"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete vendor')
                                            <a class="btn btn-danger btn-sm"
                                               data-bs-target="#deleteCategory{{$item->id}}"
                                               data-bs-toggle="modal"
                                               href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                        @endcan
                                        <a class="btn btn-info btn-sm"
                                           href="{{route('admin.show_product_vendor', $item->id)}}"><i
                                                class="fa fa-file-image-o"></i></a>
                                    </td>
                                </tr>
                                <!-- Update Category MODAL -->
                                <div class="modal fade" id="editProduct{{$item->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Edit Product</h6>
                                                <button aria-label="Close" class="btn-close"
                                                        data-bs-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{route('vendor.product.update')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="form-label">English Title</label>
                                                        <input type="text" name="title_en" value="{{old('title_en') }}"
                                                               class="form-control"
                                                               placeholder="English Title" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Arabic Title</label>
                                                        <input type="text" name="title_ar" value="{{old('title_ar')}}"
                                                               class="form-control"
                                                               placeholder="Arabic Title" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Category</label>
                                                        <select name="category_id"
                                                                class="form-control form-select form-select-md">
                                                            @foreach(\App\Models\Category::all() as $category)
                                                                <option
                                                                    {{$item->category_id == $category->id ? 'selected':''}} value="{{$category->id}}">{{$category->getTranslation('title', 'en') . ' - ' . $category->getTranslation('title', 'ar')}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Start Expired</label>
                                                        <input type="date" name="start_date"
                                                               value="{{old('start_date', $item->start_date)}}"
                                                               class="form-control"
                                                               placeholder="Start Expired" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">End Expired</label>
                                                        <input type="date" name="end_date"
                                                               value="{{old('end_date', $item->end_date)}}"
                                                               class="form-control"
                                                               placeholder="End Expired" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Price</label>
                                                        <input type="number" name="price"
                                                               value="{{old('price', $item->price)}}"
                                                               class="form-control"
                                                               placeholder="Price" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Quantity</label>
                                                        <input type="number" name="quantity"
                                                               value="{{old('quantity', $item->quantity)}}"
                                                               class="form-control"
                                                               placeholder="Quantity" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete vendor MODAL -->
                                <div class="modal fade" id="deleteCategory{{$item->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Delete Category</h6>
                                                <button aria-label="Close" class="btn-close"
                                                        data-bs-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                Are You Sure Delete?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{route('admin.delete_vendor', $item->id)}}"
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
    <div class="modal fade" id="addProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Create New Product</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.save_vendor')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control"
                                   placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" value="{{old('email')}}" class="form-control"
                                   placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="number" name="phone" value="{{old('phone')}}" class="form-control"
                                   placeholder="Phone" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Governorate</label>
                            <select class="form-select" name="governorate_id">
                                <option selected disabled>Governorate</option>
                                @foreach(\App\Models\Governorate::all() as $governorate)
                                    <option value="{{$governorate->id}}">{{$governorate->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label"> Password</label>
                            <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                <a href="javascript:void(0)"
                                   class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                </a>
                                <input class="input100 form-control" type="password" name="password"
                                       placeholder="Password" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                <a href="javascript:void(0)"
                                   class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                </a>
                                <input class="input100 form-control" type="password"
                                       name="password_confirmation" placeholder="Confirm Password"
                                       autocomplete="password">
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

