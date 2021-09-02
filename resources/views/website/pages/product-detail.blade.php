@extends('website.layouts.master')

@section('content')
    <div style="background-color: #f9f9f9;">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery">
                                <div class="row">

                                    <img id="product--main-image" src="{{ $product->images_url[0] }}"
                                        data-zoom-image="{{ $product->images_url[0] }}" />

                                    <div id="product-image-gallery">
                                        @foreach ($product->images_url as $product_image)
                                            <a href="javascript:void(0)" data-image="{{ $product_image }}"
                                                class="product--gallery-image {{ $loop->iteration === 1 ? 'active' : '' }}"
                                                data-zoom-image="{{ $product_image }}">
                                                <img id="img_01" src="{{ $product_image }}" />
                                            </a>
                                        @endforeach
                                    </div>

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
                                @if ($product->brand)
                                    <div>
                                        <span class="font-weight-bold">Brand:</span>
                                        {{ $product->brand->name }}
                                    </div>
                                @endif
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
                                        <a href="javascript:fbshareCurrentPage()" class="social-icon"
                                            data-platform="facebook" title="Facebook"><i class="icon-facebook-f"></i></a>
                                        <a href="javascript:twitterShareCurrentPage()" class="social-icon"
                                            title="Twitter"><i class="icon-twitter"></i></a>
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
    <script src="{{ asset('website/js/elevatezoom.js') }}"></script>
    <script language="javascript">
        function fbshareCurrentPage() {
            window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href) + "&t=" +
                document.title, '',
                'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
            return false;
        }

        function twitterShareCurrentPage() {
            window.open("https://twitter.com/intent/tweet?url=" + encodeURIComponent(window.location.href) + "&t=" +
                document.title, '',
                'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
            return false;
        }
    </script>
    <script>
        window.onload = function() {
            $('.ratings-val').each(function() {
                let rating = $(this).data('rating')
                $(this).css('width', rating + '%')
            })
        }
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
                            footer: '<a href="/shop/cart">Go to Cart <i class="icon-shopping-cart"></i>'
                        });
                        $('.product_quantity').val('1');
                    }
                });
            });

            if ($(window).width() > 550)
            // scrollZoom: true,
            {
                let zoomConfig = {
                    gallery: 'product-image-gallery',
                    cursor: 'pointer',
                    galleryActiveClass: 'active',
                    imageCrossfade: true,
                    loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif',
                    zoomWindowHeight: '600',
                    zoomWindowWidth: '600',
                    easing: true,
                    scrollZoom: true,
                    responsive: true
                }

                $("#product--main-image").elevateZoom(zoomConfig);
                $("#product--main-image").bind("click", function(e) {
                    var ez = $('#product--main-image').data('elevateZoom');
                    $.fancybox(ez.getGalleryList());
                    return false;
                });
            } else {
                $(document).on('click', '.product--gallery-image ', function() {
                    let image = $(this).data('image');
                    $('.product--gallery-image').removeClass('active')
                    $(this).addClass('active')

                    $('#product--main-image').attr('src', image)
                })
            }
        })
    </script>
@endpush

<style>
    #product-image-gallery img {
        border: 2px solid white !important;
        width: 100px !important;
        margin: 10px 5px 0px 0px;
        display: inline-block !important;
    }

    #product-image-gallery a.active img {
        border: 2px solid #333 !important;
        padding: 2px !important
    }

    @media screen and (max-width: 550px) {
        .zoomContainer {
            display: none;
        }
    }

</style>
