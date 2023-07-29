@extends('admin.layouts.master')
@section('title', 'Publish')
@section('main-header', 'Publish')
@section('header', 'Products')
@section('title_header', 'Publish')
@section('content')
    <form action="{{ route('admin.publishSelected') }}" method="post">
        @csrf
        @if (count($products) > 0)
            <div class="card">
                <div class="card-body">
                    <input type="submit" value="Publish Selected" class="btn btn-primary">
                </div>
            </div>
        @endif
        <div class="tab-content">
            <div class="tab-pane active" id="tab-11">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-sm-6 col-md-6 col-xl-3 alert">
                            <div class="card">
                                <div class="product-grid6">
                                    <div class="product-image6 p-5">
                                        <ul class="icons-wishlist" style="z-index: 1000; height: fit-content">
                                            <li>
                                                <label class="colorinput">
                                                    <input name="ids[]" type="checkbox" value="{{ $product->id }}"
                                                        class="colorinput-input">
                                                    <span class="colorinput-color bg-indigo"></span>
                                                </label>
                                            </li>
                                        </ul>
                                        <ul class="icons" style="direction: rtl; z-index:2">
                                            <li title="Delete"><a data-bs-target="#delete{{ $product->id }}"
                                                    data-bs-toggle="modal" href="javascript:void(0)"
                                                    class="btn btn-danger"><i class="fe fe-x"></i></a></li>
                                            <li title="Edit">
                                                <a href="javascript:void(0)" class="btn btn-success"
                                                    data-bs-target="#editProduct{{ $product->id }}" data-bs-toggle="modal"
                                                    href="javascript:void(0)">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                            </li>
                                            <li title="Edit Images">
                                                <a href="{{ route('admin.product.images', $product->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="fe fe-image"></i>
                                                </a>
                                            </li>
                                        </ul>
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
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="product-content text-center">
                                            <h1 class="title fw-bold fs-20 text-truncate">
                                                <a href="{{ route('admin.show', $product->id) }}">{{ $product->title }}</a>
                                            </h1>
                                            <div class="price mb-2">${{ $product->price }}</div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="{{ route('admin.sharing_product_vendor', $product->id) }}"
                                            class="btn btn-primary mx-2 mb-1 w-sm"><i
                                                class="fe fe-shopping-cart me-2"></i>Publish</a>
                                        <a href="cart.html" title="Add a percentage" class="btn btn-info mx-2 mb-1 w-sm"
                                            data-bs-toggle="modal" data-bs-target="#percentage{{ $product->id }}"><i
                                                class="fe fe-percent mx-2"></i>Add a percentage</a>
                                        <a href="{{ url('admin/product/unsharing/' . $product->id . '/' . 'true') }}"
                                            class="btn btn-danger mx-2 mb-1 w-sm"><i
                                                class="fe fe-delete me-2 text-dark"></i>Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Add a percentage --}}
                        <div class="modal  fade" id="percentage{{ $product->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Percentage</h5>
                                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.add_percentage_product') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Add Or Update Percentage <span class="text-danger">*</span>
                                                    <input type="text" name="percentage"
                                                        value="{{ old('percentage', $product->percentage) }}"
                                                        class="form-control" placeholder="Add Or Update Percentage"
                                                        required>
                                                </label>
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Delete Product --}}
                        <div class="modal fade" id="delete{{ $product->id }}">
                            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                <div class="modal-content tx-size-sm">
                                    <div class="modal-body text-center p-4 pb-5">
                                        {{-- <button aria-label="Close" class="btn-close position-absolute"
                                            data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button> --}}
                                        <i class="icon icon-close fs-70 text-danger lh-1 my-5 d-inline-block"></i>
                                        <h4 class="text-danger">You are about to delete the product</h4>
                                        <a href="{{ url('admin/product/unsharing/' . $product->id . '/' . 'true') }}"
                                            class="btn btn-danger pd-x-25">Continue</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Edit Product --}}
                        <div class="modal fade" id="editProduct{{ $product->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Edit Product</h6>
                                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                                                aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="{{ route('admin.product.update') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="form-label">English Title</label>
                                                <input type="text" name="title_en"
                                                    value="{{ old('title_en', $product->getTranslation('title', 'en')) }}"
                                                    class="form-control" placeholder="English Title" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Arabic Title</label>
                                                <input type="text" name="title_ar"
                                                    value="{{ old('title_ar', $product->getTranslation('title', 'ar')) }}"
                                                    class="form-control" placeholder="Arabic Title" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Category</label>
                                                <select name="category_id"
                                                    class="form-control form-select form-select-md">
                                                    @foreach (\App\Models\Category::all() as $category)
                                                        <option
                                                            {{ $product->category_id == $category->id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">
                                                            {{ $category->getTranslation('title', 'en') . ' - ' . $category->getTranslation('title', 'ar') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Expired Dtae</label>
                                                <input type="date" name="start_date"
                                                    value="{{ old('start_date', $product->start_date) }}"
                                                    class="form-control" placeholder="Start Expired" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Price</label>
                                                <input type="number" name="price"
                                                    value="{{ old('price', $product->price) }}" class="form-control"
                                                    placeholder="Price" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" name="quantity"
                                                    value="{{ old('quantity', $product->quantity) }}"
                                                    class="form-control" placeholder="Quantity" required>
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
                    @endforeach
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')

@endsection
