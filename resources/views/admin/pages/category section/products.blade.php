@extends('admin.layouts.master')
@section('title', 'All product')
@section('main-header', 'All product')
@section('header', 'Category')
@section('title_header', 'All product')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.category_section.create')}}?section_id= {{$id}}" class="btn btn-primary">Add
                New Product</a>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-6 col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="product-grid6">
                                <div class="product-image6 p-5">
                                    <a href="{{ route('admin.show', $product->id) }}" title="{{ $product->title }}">
                                        @if (count($product->images) > 0)
                                            <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($product->images as $index => $image)
                                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                            <img class="d-block br-5" alt="" style="height: 200px"
                                                                 src="{{ asset('assets/' . $image->path) }}"
                                                                 data-bs-holder-rendered="true">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev d-flex align-items-center"
                                                   href="#carousel-controls" role="button" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next d-flex align-items-center"
                                                   href="#carousel-controls" role="button" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        @else
                                            <img class="img-fluid br-7 w-100" style="height: 200px"
                                                 src="{{ asset('assets/images/products/7.jpg') }}" alt="img">
                                        @endif

                                    </a>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="product-content text-center">
                                        <h1 class="title fw-bold fs-20 text-truncate" title="{{ $product->title }}"><a
                                                href="{{ route('admin.show', $product->id) }}">
                                                {{ $product->title }}
                                            </a></h1>
                                        @if ($product->total_price)
                                            <div class="price" title="${{ $product->total_price }}">
                                                ${{ $product->total_price }}</div>
                                        @else
                                            <div class="price" title="${{ $product->price }}">${{ $product->price }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a data-bs-target="#delete{{ $product->id }}"
                                       data-bs-toggle="modal" href="javascript:void(0)"
                                       title="Delete" class="btn btn-outline-danger mb-1"><i
                                            class="fa fa-close mx-2 delete-icon"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Delete Product --}}
                    <div class="modal fade" id="delete{{ $product->id }}">
                        <div class="modal-dialog modal-dialog-centered text-center" role="document">
                            <div class="modal-content tx-size-sm">
                                <div class="modal-body text-center p-4 pb-5">
                                    <button aria-label="Close" class="btn-close position-absolute"
                                            data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                    <i class="icon icon-close fs-70 text-danger lh-1 my-5 d-inline-block"></i>
                                    <h4 class="text-danger">You are about to delete the product</h4>
                                    <form action="{{route('admin.category_section.delete', $product->id)}}"
                                          method="post"
                                          id="formDelete{{$product->id}}">@csrf @method("DELETE")</form>
                                    <button type="submit" form="formDelete{{$product->id}}"
                                            class="btn btn-outline-danger">Continue
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
