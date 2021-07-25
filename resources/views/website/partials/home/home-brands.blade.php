@inject('brand_helper', 'App\Helpers\BrandHelper')

@php
$brands = $brand_helper->getFeaturedBrands(true);
@endphp

<div class="container">
    <h2 class="title title-border mb-5">Shop by Brands</h2>
    <div class="owl-carousel brands-slider mb-5 owl-simple">
        @foreach ($brands as $brand)
            <a href="#" class="brand">
                <img src="{{ $brand->logo_url }}" alt="Brand Name">
            </a>
        @endforeach
    </div>
</div>
