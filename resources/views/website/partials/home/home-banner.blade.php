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
    </div>

    <span class="slider-loader"></span>
</div>
