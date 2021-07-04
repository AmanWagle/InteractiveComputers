<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="/storage/images/static/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-item {{ request()->segment(2) === 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ request()->segment(2) === 'pages' ? 'active' : '' }}">
                    <a href="{{ route('admin.pages.index') }}" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Pages</span>
                    </a>
                </li> --}}

                <li class="sidebar-title">eCommerce Catalog</li>

                <li class="sidebar-item {{ request()->segment(2) === 'product-category' ? 'active' : '' }} ">
                    <a href="{{ route('admin.product-category.index') }}" class='sidebar-link'>
                        <i class="fas fa-dice"></i>
                        <span>Categories</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->segment(2) === 'brand' ? 'active' : '' }} ">
                    <a href="{{ route('admin.brand.index') }}" class='sidebar-link'>
                        <i class="bi bi-bootstrap-fill"></i>
                        <span>Brands</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->segment(2) === 'product' ? 'active' : '' }} ">
                    <a href="{{ route('admin.product.index') }}" class='sidebar-link'>
                        <i class="bi bi-bag-fill"></i>
                        <span>Products</span>
                    </a>
                </li>

                <li class="sidebar-title">Website Section</li>
                <li class="sidebar-item {{ request()->segment(2) === 'page' ? 'active' : '' }} has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-earmark-code-fill"></i>
                        <span>Pages</span>
                    </a>
                    <ul class="submenu d-block">
                        <li class="submenu-item {{ request()->segment(2) === 'page' ? 'active' : '' }}">
                            <a href="{{ route('admin.page.index') }}">All Pages</a>
                        </li>

                        <li class="submenu-item ">
                            <a href="#">Page 1</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="#">Page 2</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ request()->segment(2) === 'banner' ? 'active' : '' }} ">
                    <a href="{{ route('admin.banner.index') }}" class='sidebar-link'>
                        <i class="bi bi-bag-fill"></i>
                        <span>Banners</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->segment(2) === 'profile' ? 'active' : '' }} ">
                    <a href="{{ route('admin.profile.show') }}" class='sidebar-link'>
                        <i class="bi bi-bag-fill"></i>
                        <span>Profile</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
