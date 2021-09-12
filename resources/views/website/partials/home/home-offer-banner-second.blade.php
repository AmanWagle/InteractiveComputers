@inject('banner_helper', 'App\Helpers\BannerHelper')

@php
$banner_images = $banner_helper->getBannerImages('home-offer-banner-second');
@endphp

@if ($banner_images)
    <div class="container">
        <div class="row">
            @foreach ($banner_images as $banner_image)
                <div class="col-lg-6">
                    <div class="banner banner-overlay banner-overlay-light">
                        <a href="{{ $banner_image->link }}">
                            <img src="{{ $banner_image->banner_image_url }}" alt="Banner">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
