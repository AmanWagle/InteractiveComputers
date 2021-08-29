<div class="product">
    <figure class="product-media product--image-wrapper">

        @if ($product->discount)
            <span class="product-label label-sale">Sale</span>
        @endif

        <a href="{{ route('product.detail', ['product' => $product->slug]) }}">
            <img src="{{ $product->images_url[0] }}" alt="Product image" class="product-image">
        </a>

        {{-- <div class="product-action-vertical">
            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick
                    view</span></a>
        </div> --}}

        {{-- <div class="product-action">
            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to
                    cart</span></a>
        </div> --}}
    </figure>

    <div class="product-body">
        {{-- <div class="product-cat">
            <a href="#">Hello</a>
        </div> --}}
        <h3 class="product-title"><a
                href="{{ route('product.detail', ['product' => $product->slug]) }}">{{ $product->name }}</a></h3>

        <div class="product-price">

            <span class="new-price">Rs.
                {{ $product->discount ? $product->selling_price : $product->original_price }}</span>
            @if ($product->discount)
                <span class="old-price">Was {{ $product->original_price }}</span>
            @endif

        </div>
        <div class="ratings-container">
            <div class="ratings">
                <div class="ratings-val" style="width: {{ ($product->average_rating / 5) * 100 }}%"></div>
            </div>
            <span class="ratings-text">( {{ count($product->reviews) }} Reviews )</span>
        </div>
    </div>
</div>
