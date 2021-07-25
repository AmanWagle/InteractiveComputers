@inject('product_helper', 'App\Helpers\ProductHelper')
@inject('category_helper', 'App\Helpers\CategoryHelper')

@php
$featured_categories = $category_helper->getFeaturedCategories();
@endphp

@foreach ($featured_categories as $category)
    @php
        $products = $product_helper->getProductsByCategory($category->id);
    @endphp
    <div class="bg-light pt-3 pb-5">
        <div class="container">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title">{{ $category->name }}</h2>
                </div>
            </div>

            <div class="tab-content tab-content-carousel">
                <div class="tab-pane p-0 fade show active" id="hot-all-tab" role="tabpanel"
                    aria-labelledby="hot-all-link">
                    <div class="products-slider owl-carousel owl-simple carousel-equal-height carousel-with-shadow">
                        @each('website.partials.product-list-single', $products, 'product')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3"></div>
@endforeach
