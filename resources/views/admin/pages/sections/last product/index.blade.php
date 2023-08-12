@extends('admin.layouts.master')
@section('title', 'Last Product')
@section('main-header', 'Last Product')
@section('header', 'Sections')
@section('title_header', 'Last Product')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fullscreenmodal"
                        href="javascript:void(0)">Add
                        New Product</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom text-center" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Product</th>
                                    <th class="wd-15p border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <a href="{{ route('admin.order.showProduct', $item->id) }}"
                                                class="btn btn-primary">Show</a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteImage{{ $item->id }}""
                                            href="javascript:void(0)">
                                                <i class="fe fe-trash"></i>
                                            </a>
                                        </td>
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
                                                        <a href="{{ route('admin.section.offer.destroy', $item->id) }}"
                                                            class="btn btn-primary">Delete</a>
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
    <!-- Create Product MODAL -->
    <!-- Modal -->
    <div class="modal fade" id="fullscreenmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('admin.section.lastProduct.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-sm-6 col-md-6 col-xl-3 alert">
                                    <div class="card">
                                        <div class="product-grid6">
                                            <div class="product-image6 p-5">
                                                <ul class="icons-wishlist" style="z-index: 1000; height: fit-content">
                                                    <li>
                                                        <label class="colorinput">
                                                            <input name="ids[]" type="checkbox"
                                                                value="{{ $product->id }}" class="colorinput-input">
                                                            <span class="colorinput-color bg-indigo"></span>
                                                        </label>
                                                    </li>
                                                </ul>
                                                @if (count($product->images) > 0)
                                                    <div id="carousel-controls" class="carousel slide"
                                                        data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @foreach ($product->images as $index => $image)
                                                                <div
                                                                    class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                    <img class="d-block br-5" alt=""
                                                                        style="height: 200px"
                                                                        src="{{ asset('assets/' . $image->path) }}"
                                                                        data-bs-holder-rendered="true">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <a class="carousel-control-prev d-flex align-items-center"
                                                            href="#carousel-controls" role="button" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon"
                                                                aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next d-flex align-items-center"
                                                            href="#carousel-controls" role="button" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon"
                                                                aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                @else
                                                    <img class="img-fluid br-7 w-100" style="height: 200px"
                                                        src="{{ asset('assets/images/products/7.jpg') }}" alt="img">
                                                @endif
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="product-content text-center">
                                                    <h1 class="title fw-bold fs-20 text-truncate">
                                                        <a
                                                            href="{{ route('admin.show', $product->id) }}">{{ $product->title }}</a>
                                                    </h1>
                                                    <div ><h4 class="title fw-bold fs-20 d-inline-block">Id : </h4> {{ $product->id }}</div>
                                                    <div class="price mb-2">${{ $product->price }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
