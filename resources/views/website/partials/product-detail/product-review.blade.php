<div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">

    @guest
        <div class="reviews d-flex justify-content-center">
            <div class="row no-gutters ">
                <b>Login to post review. &nbsp;<a href="#signin-modal" data-toggle="modal">Sign in</a></b>
            </div>
        </div>
    @endguest

    @auth
        @php
            $user_review = \App\Models\RatingReview::where('user_id', auth()->user()->id)
                ->where('product_id', $product->id)
                ->first();
        @endphp
        @if ($user_review)
            <div class="reviews">
                <h3>Your Review</h3>
                <div class="review your-review">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex" style="justify-content: space-between;">
                                <h4>{{ $user_review->review_summary }}</h4>
                                <div class="ratings">
                                    <div class="ratings-val" data-rating="{{ $user_review->rating_percentage }}"></div>
                                </div>
                            </div>
                            <div class="review-content">
                                <p>
                                    {{ $user_review->review }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="review-date">{{ $user_review->created_at->diffForHumans() }}</span>
                                <div>
                                    @if ($user_review->status)
                                        <span class="badge rounded-pill bg-success text-white"
                                            style="font-size: 14px;">Posted</span>
                                    @else
                                        <span class="badge rounded-pill bg-dark text-white" style="font-size: 14px;">In
                                            Review</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- vue component for rating --}}
            <rating-review :product_id="{{ $product->id }}"></rating-review>
        @endif
    @endauth

    <hr />

    <div class="reviews">
        <h3>Ratings and Reviews</h3>
        @if (!count($product->reviews))
            <div class="reviews d-flex justify-content-center">
                <div class="row no-gutters ">
                    <b>No review yet. Be the first to review this product.</b>
                </div>
            </div>
        @else
            @foreach ($product->reviews as $review)
                <div class="review">
                    <div class="row no-gutters">
                        <div class="col-2">
                            <h4><a href="#">{{ $review->user->name }}</a></h4>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" data-rating="{{ $review->rating_percentage }}"></div>
                                </div>
                            </div>
                            <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="col-10">
                            <h4>{{ $review->review_summary }}</h4>
                            <div class="review-content">
                                <p>
                                    {{ $review->review }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>

<script>
    window.onload = function() {
        $('.ratings-val').each(function() {
            let rating = $(this).data('rating')
            $(this).css('width', rating + '%')
        })
    }
</script>
