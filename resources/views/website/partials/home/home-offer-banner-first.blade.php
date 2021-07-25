@inject('banner_helper', 'App\Helpers\BannerHelper')

@php
$banner_images = $banner_helper->getBannerImages('home-offer-banner-first');
@endphp

@if ($banner_images)
    <div class="container">
        <div class="row">
            @foreach ($banner_images as $banner_image)
                <div class="{{ $loop->iteration % 2 !== 0 ? 'col-sm-6 col-lg-3' : 'col-lg-6' }}">
                    <div class="banner banner-overlay">
                        <a href="#">
                            <img src="{{ $banner_image->banner_image_url }}" alt="Banner">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
