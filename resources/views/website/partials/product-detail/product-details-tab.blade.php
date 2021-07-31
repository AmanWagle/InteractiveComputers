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
                    <table class="table" border="2">
                        <tbody>
                            <tr>
                                <td>CPU</td>
                                <td><span>4000-series AMD Ryzen 5 4500U Processor</span></td>
                            </tr>
                            <tr>
                                <td>OS</td>
                                <td>Windows 10 Home</td>
                            </tr>
                            <tr>
                                <td>Display</td>
                                <td><span>14-inch Full-HD (1920 x 1080 pixels), IPS-Level</span></td>
                            </tr>
                            <tr>
                                <td>Graphics</td>
                                <td><span>AMD Radeon Graphics</span></td>
                            </tr>
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
