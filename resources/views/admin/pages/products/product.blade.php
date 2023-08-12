@extends('admin.layouts.master')
@section('title', 'Products')
@section('main-header', 'Products')
@section('header', 'Products')
@section('title_header', 'Products')
@section('content')
    <!-- ROW-1 OPEN -->
    <div class="row row-cards">
        <!-- COL-END -->
        <div class="col-xl-12 col-lg-12">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-6 col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="product-grid6">
                                <div class="product-image6 p-5">
                                    <ul class="icons">
                                        <li title="Delete"><a data-bs-target="#delete{{ $product->id }}"
                                                data-bs-toggle="modal" href="javascript:void(0)" class="btn btn-danger"><i
                                                    class="fe fe-x"></i></a></li>
                                        <li title="Edit">
                                            <a href="javascript:void(0)" class="btn btn-success"
                                                data-bs-target="#editProduct{{ $product->id }}" data-bs-toggle="modal"
                                                href="javascript:void(0)">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                        </li>
                                        <li title="Edit Images">
                                            <a href="{{route('admin.product.images', $product->id)}}" class="btn btn-primary">
                                                <i class="fe fe-image"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <a href="{{ route('admin.show', $product->id) }}" title="{{ $product->title }}">
                                        @if (count($product->images) > 0)
                                            <img class="img-fluid br-7" style="height: 230px;"
                                                src="{{ asset('assets/' . $product->images[0]->path) }}" alt="img">
                                        @else
                                            <img class="img-fluid br-7 w-100" style="height: 230px;"
                                                src="{{ asset('assets/images/products/8.jpg') }}" alt="img">
                                        @endif

                                    </a>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="product-content text-center">
                                        <h1 class="title fw-bold fs-20 text-truncate" title="{{ $product->title }}"><a
                                                href="{{ route('admin.show', $product->id) }}">
                                                {{ $product->title }}
                                            </a></h1>
                                        <div ><h4 class="title fw-bold fs-20 d-inline-block">Id : </h4> {{ $product->id }}</div>
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
                                    <a href="cart.html" title="Add a percentage" class="btn btn-primary mb-1"
                                        data-bs-toggle="modal" data-bs-target="#percentage{{ $product->id }}"><i
                                            class="fe fe-percent mx-2"></i>Add a percentage</a>
                                    <a href="{{ url('admin/product/unsharing/' . $product->id . '/' . 'false') }}"
                                        title="UnPublish" class="btn btn-outline-danger mb-1"><i
                                            class="fa fa-close mx-2 wishlist-icon"></i>UnPublish</a>
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
                                                    class="form-control" placeholder="Add Or Update Percentage" required>
                                            </label>
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
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
                                    <button aria-label="Close" class="btn-close position-absolute"
                                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
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
                                            <select name="category_id" class="form-control form-select form-select-md">
                                                @foreach (\App\Models\Category::all() as $category)
                                                    <option {{ $product->category_id == $category->id ? 'selected' : '' }}
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
                                                value="{{ old('quantity', $product->quantity) }}" class="form-control"
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
                @endforeach
            </div>
            <!-- COL-END -->
        </div>
        <!-- ROW-1 CLOSED -->
    </div>
    <!-- ROW-1 END -->
@endsection

@section('scripts')

@endsection
