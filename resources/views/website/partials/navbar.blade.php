<header class="header header-10 header-intro-clearance">
    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{ route('website.home') }}" class="logo">
                    {{-- <h5>Interactive World</h5> --}}
                    <img src="/images/interactive_logo.png" alt="Interactive World Logo" width="190" height="25">
                </a>
            </div>

            <div class="header-center">
                <div
                    class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="/shop" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..."
                                required>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="header-right">
                <div class="header-dropdown-link">

                    <cart-quickview></cart-quickview>

                    @auth
                        <a href="{{ route('user.profile') }}" class="wishlist-link">
                            <i class="icon-user"></i>
                            <span class="wishlist-txt">{{ auth()->user()->name }}</span></a></a>
                    @endauth

                    @guest
                        <a href="#signin-modal" class="wishlist-link" data-toggle="modal">
                            <i class="icon-user"></i>
                            <span class="wishlist-txt">Sign in / Sign up</span></a>
                    @endguest

                    <form id="user-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <div class="dropdown category-dropdown show is-on" data-visible="true">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true" data-display="static" title="Browse Categories">
                        Browse Categories
                    </a>
                    <div class="dropdown-menu {{ request()->segment(1) === null ? 'show' : '' }}">
                        <nav class="side-nav">
                            <ul class="menu-vertical sf-arrows">
                                @foreach ($product_categories as $category)
                                    <li>
                                        <a class="d-flex" href="/shop?category={{ $category->slug }}">
                                            <img src="{{ $category->icon_url }}" alt width="25px"
                                                style="margin-right: 10px;" /><span
                                                class="align-middle">{{ $category->name }}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        {{-- home --}}
                        <li class="{{ request()->segment(1) === null ? 'active' : '' }}">
                            <a href="{{ route('website.home') }}">Home</a>
                        </li>
                        @foreach ($product_categories->slice(0, 5) as $category)
                            <li>
                                <a href="/shop?category={{ $category->slug }}"
                                    class="{{ sizeof($category->children) ? 'sf-with-ul' : '' }}">{{ $category->name }}</a>
                                @if (sizeof($category->children))
                                    <ul>
                                        @foreach ($category->children as $children_level_1)
                                            <li>
                                                <a href="/shop?category={{ $children_level_1->slug }}"
                                                    class="{{ sizeof($children_level_1->children) ? 'sf-with-ul' : '' }}">{{ $children_level_1->name }}</a>
                                                @if (sizeof($children_level_1->children))
                                                    <ul>
                                                        @foreach ($children_level_1->children as $children_level_2)

                                                            <li><a
                                                                    href="/shop?category={{ $children_level_2->slug }}">{{ $children_level_2->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .col-lg-9 -->
            <div class="header-right">
                <ul class="menu sf-arrows">
                    <li><a href="tel:014524879"><i class="icon-phone"></i>014524879</a></li>
                    <li><a href="tel:014517055"><i class="icon-phone"></i>014517055</a></li>
                </ul>
            </div>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
