@inject('product_helper', 'App\Helpers\ProductHelper')

@php
$products = $product_helper->getProductsByCategory($category->id, true, 15);
@endphp

<h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
<div class="products-slider owl-carousel owl-simple carousel-equal-height carousel-with-shadow">
    @each('website.partials.product-list-single', $products, 'product')
</div><!-- End .owl-carousel -->
