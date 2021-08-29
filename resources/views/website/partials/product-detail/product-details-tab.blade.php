<div class="shadow-sm p-3 mb-5 bg-white rounded product-details-tab">
    <ul class="nav nav-pills justify-content-center" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="product-specification-link" data-toggle="tab"
                href="#product-specification-tab" role="tab" aria-controls="product-info-tab"
                aria-selected="true">SPECIFICATIONS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab"
                aria-controls="product-desc-tab" aria-selected="false">PRODUCT DESCRIPTION</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab"
                aria-controls="product-review-tab" aria-selected="false">RATINGS AND REVIEWS</a>
        </li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane fade show active" id="product-specification-tab" role="tabpanel"
            aria-labelledby="product-specification-link">
            <div class="reviews">
                <h3>Product Specification</h3>
                <div>
                    <table class="table spec-table" border="2">
                        <tbody>
                            @if (!count($product->specifications_array))
                                <div class="reviews d-flex justify-content-center">
                                    <div class="row no-gutters ">
                                        <b>Specification is not mentioned. Please check prodect description.</b>
                                    </div>
                                </div>
                            @else
                                @foreach ($product->specifications_array as $spec)
                                    <tr>
                                        <td>{{ $spec['variable'] }}</td>
                                        <td><span>{{ $spec['value'] }}</span></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- .End .tab-pane -->

        <div class="tab-pane fade" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
            <div class="reviews">
                <h3>Product Description</h3>
                <p>{{ $product->description }}</p>
            </div>
        </div>

        @include('website.partials.product-detail.product-review', ['product' => $product])

    </div>
</div><!-- End .product-details-content -->
