@extends('admin.layouts.master')
@section('title', 'Product')
@section('main-header', 'Product')
@section('header', 'Product')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">English Title</th>
                                <th class="wd-20p border-bottom-0">Arabic Title</th>
                                <th class="wd-20p border-bottom-0">Category</th>
                                <th class="wd-20p border-bottom-0">Price</th>
                                <th class="wd-20p border-bottom-0">Quantity</th>
                                <th class="wd-20p border-bottom-0">Status</th>
                                <th class="wd-20p border-bottom-0">Start Expired</th>
                                <th class="wd-20p border-bottom-0">End Expired</th>
                                <th class="wd-20p border-bottom-0">percentage</th>
                                <th class="wd-20p border-bottom-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vendor_product as $index=>$item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->getTranslation('title', 'en')}}</td>
                                    <td>{{$item->getTranslation('title', 'ar')}}</td>
                                    <td>{{$item->category->getTranslation('title', 'en') . ' - ' . $item->category->getTranslation('title', 'ar')}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>
                                        @if($item->status > 0)
                                            <span
                                                class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shared</span>
                                            <div class="m-1">
                                                <a class="btn btn-info btn-sm "
                                                   href="{{route('admin.unsharing_product_vendor', $item->id)}}">UnShared</a>
                                            </div>

                                        @else
                                            <a class="btn btn-info btn-sm "
                                               href="{{route('admin.sharing_product_vendor', $item->id)}}">sharing</a>
                                        @endif
                                    </td>
                                    <td>{{$item->start_date}}</td>
                                    <td>{{$item->end_date}}</td>
                                    <td class=" ">
                                        <form class="row gap-2 " action="{{route('admin.add_percentage_product')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$item->id}}">
                                            <input  type="text"   class="  col-5  form-control" name="percentage"
                                                   value="{{$item->percentage}}">
                                            <button type="submit" class=" col-4 btn btn-info "><i class="fa fa-file-archive-o "></i></button>

                                        </form>
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm" data-bs-target="#editProduct{{$item->id}}"
                                           data-bs-toggle="modal"
                                           href="javascript:void(0)"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-danger btn-sm" data-bs-target="#deleteCategory{{$item->id}}"
                                           data-bs-toggle="modal"
                                           href="javascript:void(0)"><i class="fa fa-trash"></i></a>

{{--                                        <a class="btn btn-info btn-sm"--}}
{{--                                           href="{{route('admin.product.images', $item->id)}}">

<iclass="fa fa-file-image-o"></i></a>--}}
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
                                            <form action="{{route('admin.product.update')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="form-label">English Title</label>
                                                        <input type="text" name="title_en"
                                                               value="{{old('title_en', $item->getTranslation('title', 'en'))}}"
                                                               class="form-control"
                                                               placeholder="English Title" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Arabic Title</label>
                                                        <input type="text" name="title_ar"
                                                               value="{{old('title_ar', $item->getTranslation('title', 'ar'))}}"
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

                                <!-- Delete Category MODAL -->
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
                                                <a href="{{route('admin.product.destroy', $item->id)}}"
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
                <form action="{{route('vendor.product.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">English Title</label>
                            <input type="text" name="title_en" value="{{old('title_en')}}" class="form-control"
                                   placeholder="English Title" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Arabic Title</label>
                            <input type="text" name="title_ar" value="{{old('title_ar')}}" class="form-control"
                                   placeholder="Arabic Title" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-control form-select form-select-md">
                                <option selected disabled>Category</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option
                                        value="{{$category->id}}">{{$category->getTranslation('title', 'en') . ' - ' . $category->getTranslation('title', 'ar')}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Start Expired</label>
                            <input type="date" name="start_date" value="{{old('start_date')}}" class="form-control"
                                   placeholder="Start Expired" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">End Expired</label>
                            <input type="date" name="end_date" value="{{old('end_date')}}" class="form-control"
                                   placeholder="End Expired" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" value="{{old('price')}}" class="form-control"
                                   placeholder="Price" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" value="{{old('quantity')}}" class="form-control"
                                   placeholder="Quantity" required>
                        </div>
                        <div class="form-group">
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
