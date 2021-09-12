@inject('banner_helper', 'App\Helpers\BannerHelper')

@php
$banner_images = $banner_helper->getBannerImages('home-offer-banner-first');
@endphp

@if ($banner_images)
    <div class="container-fluid">
        <div class="row justify-content-center">
            @foreach ($banner_images as $banner_image)
                <div class="col-md-4">
                    <div class="banner banner-overlay">
                        <a href="{{ $banner_image->link }}">
                            <img src="{{ $banner_image->banner_image_url }}" alt="Banner">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
