<div class="col-md-3">
    <div class="card shadow">
        <div class="m-5">
            <img src="/storage/images/static/profileImage.jpg" class="img-thumbnail m-auto mb-2"
                style="max-height: 170px" />

            <div class="nav flex-column nav-pills" id="v-pills-tab" aria-orientation="vertical">
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(2) === null ? 'active' : '' }}"
                        href="{{ route('user.profile') }}">Account Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(2) === 'orders' ? 'active' : '' }}" href="{{ route('user.profile.all-orders') }}">Order History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(2) === 'security' ? 'active' : '' }}" href="{{ route('user.profile.security') }}">Security</a>
                </li>
            </div>

            <a href="javascript:void(0)"
                onclick="event.preventDefault(); document.getElementById('user-logout-form').submit();" role="tab"
                class="btn btn-primary btn-block mt-1">
                <i class="icon-arrow-left"></i>Logout</a>
        </div>
    </div>
</div>
