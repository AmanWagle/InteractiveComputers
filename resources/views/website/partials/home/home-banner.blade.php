@inject('banner_helper', 'App\Helpers\BannerHelper')

@php
$banner_images = $banner_helper->getBannerImages('home-slider-banner');
@endphp

<div class="intro-slider-container">
    <div class="intro-slider owl-carousel owl-simple owl-nav-inside">

        @foreach ($banner_images as $image)
            <a href="{{ $image->link }}">
                <div class="intro-slide" style="background-image: url({{ $image->banner_image_url }});"></div>
            </a>
        @endforeach

        {{-- <div class="intro-slide" style="background-image: url(assets/images/demos/demo-13/slider/slide-1.png);">
            <div class="container intro-content">
                <div class="row">
                    <div class="col-auto offset-lg-3 intro-col">
                        <h3 class="intro-subtitle">Trade-In Offer</h3>
                        <h1 class="intro-title">MacBook Air <br>Latest Model
                            <span>
                                <sup class="font-weight-light">from</sup>
                                <span class="text-primary">$999<sup>,99</sup></span>
                            </span>
                        </h1>

                        <a href="category.html" class="btn btn-outline-primary-2">
                            <span>Shop Now</span>
                            <i class="icon-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <span class="slider-loader"></span>
</div>
