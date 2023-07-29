@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('main-header', 'Dashboard')
@section('header', 'Dashboard')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    @can('create slider')
                        <a class="btn btn-primary" data-bs-target="#addProduct" data-bs-toggle="modal"
                           href="javascript:void(0)">Add New Slider</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                            <tr>

                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">English Title</th>
                                <th class="wd-20p border-bottom-0">Arabic Title</th>
                                <th class="wd-15p border-bottom-0">English description</th>
                                <th class="wd-20p border-bottom-0">Arabic description</th>
                                <th class="wd-20p border-bottom-0">Image</th>
                                <th class="wd-20p border-bottom-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($slider as $index=>$item)
                                <div class="modal fade" id="editProduct{{$item->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Edit Slider</h6>
                                                <button aria-label="Close" class="btn-close"
                                                        data-bs-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{route('admin.update_slider')}}" method="post" enctype="multipart/form-data">
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
                                                        <label class="form-label">English Description</label>
                                                        <textarea type="text" name="description_en" value=""
                                                                  class="form-control"
                                                                  placeholder="English Description"
                                                                  required> {{old('description_en', $item->getTranslation('description', 'en'))}} </textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Arabic Description</label>
                                                        <textarea type="text" name="description_ar" value=""
                                                                  class="form-control"
                                                                  placeholder="English Description"
                                                                  required> {{old('description_ar', $item->getTranslation('description', 'ar'))}} </textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Images</label>
                                                        <input type="file" name="image" multiple accept="image/*"
                                                               class="form-control form-control-lg"
                                                               placeholder="Images">
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
                                <!-- Update Category MODAL -->
                                <tr>
                                    <td>{{$index+1}}</td>

                                    <td>{{$item->getTranslation('title', 'en')}}</td>
                                    <td>{{$item->getTranslation('title', 'ar')}}</td>
                                    <td>{{$item->getTranslation('description', 'en')}}</td>
                                    <td>{{$item->getTranslation('description', 'ar')}}</td>
                                    <td>
                                        <img src="{{asset('assets/' . $item->image)}}" width="100" height="100"/>
                                    </td>
                                    <td>
                                        @can('update slider')
                                        <a class="btn btn-success btn-sm" data-bs-target="#editProduct{{$item->id}}"
                                           data-bs-toggle="modal"
                                           href="javascript:void(0)"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete slider')
                                        <a class="btn btn-danger btn-sm" data-bs-target="#deleteCategory{{$item->id}}"
                                           data-bs-toggle="modal"
                                           href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
                                </tr>

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
                                                <a href="{{route('admin.delete_slider', $item->id)}}"
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
    <!-- Create Slider MODAL -->
    <div class="modal fade" id="addProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Create New Slider</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.create_slider')}}" method="post" enctype="multipart/form-data">
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
                            <label class="form-label">English Description</label>
                            <textarea type="text" name="description_en" value="" class="form-control"
                                      placeholder="English Description" required> {{old('description_en')}} </textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Arabic Description</label>
                            <textarea type="text" name="description_ar" value="" class="form-control"
                                      placeholder="English Description" required> {{old('description_ar')}} </textarea>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Images</label>
                            <input type="file" name="image" multiple accept="image/*"
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
