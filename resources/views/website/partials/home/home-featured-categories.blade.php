@inject('category_helper', 'App\Helpers\CategoryHelper')

@php
$featured_categories = $category_helper->getFeaturedCategories();
@endphp

<div class="cta cta-horizontal cta-horizontal-box bg-primary">
    <div class="container">
        <div class="row align-items-center">
            @foreach ($featured_categories as $category)
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="/shop?category={{ $category->slug }}" class="cat-block">
                        <figure>
                            <span>
                                <img src="{{ $category->icon_url }}" alt="Category image">
                            </span>
                        </figure>

                        <h3 class="cat-block-title">{{ $category->name }}</h3>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
