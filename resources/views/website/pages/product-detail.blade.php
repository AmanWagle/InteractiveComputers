@extends('website.layouts.master')

@section('content')
    <div style="background-color: #f9f9f9;">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery product-gallery-vertical">
                                <div class="row">
                                    <figure class="product-main-image">
                                        <img id="product-zoom" src="{{ $product->images_url[0] }}"
                                            data-zoom-image="{{ $product->images_url[0] }}" alt="product image">

                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>
                                    </figure><!-- End .product-main-image -->

                                    <div id="product-zoom-gallery" class="product-image-gallery">
                                        @foreach ($product->images_url as $product_image)
                                            <a class="product-gallery-item active" href="#"
                                                data-image="{{ $product_image }}"
                                                data-zoom-image="{{ $product_image }}">
                                                <img src="{{ $product_image }}" alt="product side">
                                            </a>
                                        @endforeach
                                    </div><!-- End .product-image-gallery -->
                                </div><!-- End .row -->
                            </div><!-- End .product-gallery -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{ $product->name }}</h1><!-- End .product-title -->

                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val"
                                            style="width: {{ ($product->average_rating / 5) * 100 }}%"></div>
                                    </div>
                                    <span class="ratings-text">( {{ count($product->reviews) }} Reviews )</span>
                                </div>

                                <div class="product-price">
                                    Rs.
                                    {{ $product->discount ? $product->selling_price : $product->original_price }}&nbsp;
                                    @if ($product->discount)
                                        <span class="old-price"><strike
                                                style="font-size:18px;">{{ $product->original_price }}</strike></span>
                                    @endif
                                </div><!-- End .product-price -->

                                <div>
                                    <span class="font-weight-bold">Product Code:</span>
                                    {{ $product->product_code }}
                                </div>
                                <div>
                                    <span class="font-weight-bold">Brand:</span>
                                    {{ $product->brand->name }}
                                </div>
                                <div>
                                    <span class="font-weight-bold">Stock Available:</span>
                                    {{ $product->stock }}
                                </div>
                                <hr>

                                <h5 style="font-size: 16px;">Quantity</h5>
                                <div class="details-filter-row details-row-size">
                                    <div class="product-details-quantity">
                                        <input type="hidden" value="{{ $product->id }}" class="product_id">
                                        <input type="number" id="qty" class="form-control product_quantity" value="1"
                                            min="1" max="10" step="1" data-decimals="0" required>
                                    </div><!-- End .product-details-quantity -->
                                </div><!-- End .details-filter-row -->

                                <div class="product-details-action">
                                    <a href="#" class="btn btn-product btn-cart add-to-cart-btn"><span>add to
                                            cart</span></a>
                                </div><!-- End .product-details-action -->
                                <hr>
                                <div class="product-content">
                                    <h5 style="font-size: 16px;">Short Description</h5>
                                    <p>{{ $product->short_description }} </p>
                                </div><!-- End .product-content -->

                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span class="font-weight-bold" style="color: #666;">Category:</span>
                                        <a
                                            href="/shop?category={{ $product->category->slug }}">{{ $product->category->name }}</a>
                                    </div><!-- End .product-cat -->

                                    <div class="social-icons social-icons-sm">
                                        <span class="font-weight-bold social-label">Share:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                    </div>
                                </div><!-- End .product-details-footer -->
                            </div><!-- End .product-details -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End .product-details-top -->

                @include('website.partials.product-detail.product-details-tab', ['product' => $product])

                @include('website.partials.product-detail.product-recommendation', ['category' => $product->category])
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.add-to-cart-btn').click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product-details').find('.product_id').val();
                var product_quantity = $(this).closest('.product-details').find('.product_quantity').val();

                $.ajax({
                    method: "POST",
                    url: "/product/add-to-cart",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'product_id': product_id,
                        'product_quantity': product_quantity
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        $(document).trigger('cart-updated')
                        Vue.swal({
                            icon: 'success',
                            title: 'Added to cart.',
                            text: response.message,
                            footer: '<a href="">Go to Cart <i class="icon-shopping-cart"></i>'
                        });
                    }
                });
            });
        })
    </script>
@endpush
