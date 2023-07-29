@extends('admin.layouts.master')
@section('title', 'Show')
@section('main-header', 'Show')
@section('header', 'Products')
@section('title_header', 'Show')
@section('content')

    <!-- ROW-1 OPEN -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-xl-5 col-lg-12 col-md-12">
                            <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($product->images as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img class="d-block w-100 br-5" alt=""
                                                src="{{ asset('assets/' . $image->path) }}"
                                                data-bs-holder-rendered="true" />
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carousel-controls" role="button"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-controls" role="button"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                            <div class="mt-2 mb-4">
                                <h3 class="mb-3 fw-semibold">{{ $product->title }}</h3>
                                <h3 class="mb-4"><span
                                        class="me-2 fw-bold fs-25 d-inline-flex">${{ $product->price }}</span></h3>
                                <div class=" mt-4 mb-5"><span class="fw-bold me-2">Availability :</span>
                                    @if ($product->quantity > 0)
                                        <span class="fw-bold text-success">In-stock</span>
                                    @else
                                        <span class="fw-bold text-danger">Out-of-stock</span>
                                    @endif
                                </div>
                                <div class="row row-sm">
                                    <div class="col">
                                        <div class="mb-2 me-2 sizes">
                                            <span class="fw-bold me-4">Quantity: {{ $product->quantity }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->

@endsection

@section('scripts')

@endsection
