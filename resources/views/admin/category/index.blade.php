@extends('admin.layouts.master')
@section('title', 'Category')
@section('main-header', 'Category')
@section('header', 'Category')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    @can('create category')
                    <a class="btn btn-primary" data-bs-target="#addCategory" data-bs-toggle="modal"
                       href="javascript:void(0)">Add New Category</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">Title</th>
                                <th class="wd-15p border-bottom-0">SubCategory</th>
                                <th class="wd-20p border-bottom-0">Image</th>
                                <th class="wd-20p border-bottom-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $index=>$item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{isset($item->parent) ? $item->parents->title : 'Main Ctegory'}}</td>
                                    <td>
                                        <img src="{{asset($item->image)}}" width="100" height="100"/>

                                    </td>

                                    <td>
                                        @can('update category')
                                        <a class="btn btn-success btn-sm" data-bs-target="#editCategory{{$item->id}}"
                                           data-bs-toggle="modal"
                                           href="javascript:void(0)"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete category')
                                        <a class="btn btn-danger btn-sm" data-bs-target="#deleteCategory{{$item->id}}"
                                           data-bs-toggle="modal"
                                           href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                        @endcan
                                        <a href="{{route('admin.category_section.show', $item->id)}}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-shopping-bag"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Update Category MODAL -->
                                <div class="modal fade" id="editCategory{{$item->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Edit Category</h6>
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{route('admin.categories.update')}}" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="form-label">English Title</label>
                                                        <input type="text" name="title_en" value="{{old('title_en', $item->getTranslation('title', 'en'))}}" class="form-control"
                                                               placeholder="English Title" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Arabic Title</label>
                                                        <input type="text" name="title_ar" value="{{old('title_ar', $item->getTranslation('title', 'ar'))}}" class="form-control"
                                                               placeholder="Arabic Title" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Sub Category</label>
                                                        <select class="form-select" name="category_id">
                                                            <option @if($item->parent == null) selected @endif value="{{null}}">Main Category</option>
                                                            @foreach($mainCategories as $category)
                                                                @if($category->id != $item->id)
                                                                    <option @if($category->id == $item->parent) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Images</label>
                                                        <input type="file" name="image" multiple accept="image/*"
                                                               class="form-control form-control-lg"
                                                               placeholder="Images" >
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
                                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                                <div class="modal-body">
                                                    Are You Sure Delete?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('admin.categories.destroy', $item->id)}}" class="btn btn-primary">Delete</a>
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
    <!-- Create Category MODAL -->
    <div class="modal fade" id="addCategory">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Create New Category</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.categories.create')}}" method="post" enctype='multipart/form-data'>
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
                            <label class="form-label">Sub Category</label>
                            <select class="form-select" name="category_id">
                                <option selected value="{{null}}">Main Category</option>
                                @foreach($mainCategories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Images</label>
                            <input type="file" name="image" multiple accept="image/*"
                                   class="form-control form-control-lg"
                                   placeholder="Images" >
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
