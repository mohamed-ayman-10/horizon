<div class="row" id="ajax_response_search">
    @foreach ($products as $product)
        <div class="content col-sm-6 col-md-6 col-xl-3 alert">
            <div class="card">
                <div class="product-grid6">
                    <div class="product-image6 p-5">
                        <ul class="icons-wishlist" style="z-index: 1000; height: fit-content">
                            <li>
                                <label class="colorinput">
                                    <input name="ids[]" type="checkbox"
                                           value="{{ $product->id }}"
                                           class="colorinput-input">
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
                                <a href="{{ route('admin.show', $product->id) }}">{{ $product->title }}</a>
                            </h1>
                            <div class="price mb-2">${{ $product->price }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
