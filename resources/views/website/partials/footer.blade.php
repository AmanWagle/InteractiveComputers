<footer class="footer footer-2">
    <div class="footer-middle border-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <div class="widget widget-about">
                        <img src="/images/interactive_logo.png" alt="Interactive World Logo" width="250" height="25">

                        <div class="social-icons mt-2 mb-2">
                            <a href="https://www.facebook.com/interactivecomputerworld" class="social-icon"
                                target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                            {{-- <a href="#" class="social-icon" target="_blank" title="Twitter"><i
                                    class="icon-twitter"></i></a> --}}
                        </div><!-- End .social-icons -->

                        <div class="widget-about-info">
                            <div class="row">
                                <div class="col-sm-6 col-md-8">
                                    <span class="widget-about-title">Payment Methods</span>
                                    <div>
                                        <img class="d-inline" src="/images/eSewa.png" alt="eSewa" width="100">
                                        <img class="d-inline" src="/images/cod.png" alt="eSewa" width="100">
                                    </div>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .widget-about-info -->
                    </div><!-- End .widget about-widget -->
                </div><!-- End .col-sm-12 col-lg-3 -->

                <div class="col-sm-4 col-lg-4">
                    <div class="widget">
                        <h4 class="widget-title">Contact Us</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="tel:014524879"><i class="icon-phone">&nbsp;</i>014524879</a></li>
                            <li><a href="tel:014517055"><i class="icon-phone">&nbsp;</i>014517055</a></li>
                            <li><a href="mailto: abc@example.com"><i
                                        class="icon-envelope">&nbsp;</i>interactivecomputerworld@gmail.com</a></li>
                            <li><a href="#"><i class="icon-map-marker">&nbsp;</i>Putalisadak, Kathmandu</a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-4 col-lg-3 -->

                {{-- <div class="col-sm-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">Information</h4>

                        <ul class="widget-list">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div> --}}

                <div class="col-sm-4 col-lg-4">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li> @auth
                                    <a href="{{ route('user.profile') }}">
                                        <span class="wishlist-txt">Profile</span></a></a>
                                @endauth

                                @guest
                                    <a href="#signin-modal" data-toggle="modal">
                                        <span class="wishlist-txt">Sign in / Sign up</span></a>
                                @endguest
                            </li>
                            <li><a href="{{ route('cart') }}">View Cart</a></li>
                            <li><a href="{{ route('user.profile.all-orders') }}">Track My Order</a></li>
                        </ul>
                    </div>
                </div>
                <p>Buy a laptop in Nepal can be a tough job. Due to the small market, computer stores always bring just
                    a few models of laptops and all with limited stock. So chances of finding a laptop that fits your
                    requirements are feeble. And if you further look at the laptop price in Nepal, you will be shocked
                    to see it being exorbitantly high. Limited availability and the high price of the laptops has
                    definitely created an inconvenience amongst the customers. With a view to solving this problem, Interactive
                    World Pvt Ltd was established.</p>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">Copyright © 2021 Interactive World Pvt. Ltd. ALL RIGHTS RESERVED.</p>

            <div class="social-icons social-icons-color">
                <p>Crafted with &#10084;&#65039; by <a href="https://amanwagle.com.np" target="_blank">
                        <b class="text-primary">AMAN WAGLE</b></a>
                </p>
            </div>
        </div>
    </div>
</footer>

<form class="d-none" id="email-verification-form" method="POST" action="{{ route('verification.resend') }}">
    @csrf
</form>

@push('script')
    @if (session('trigger_login'))
        <script>
            $(document).ready(function() {
                $('#signin-modal').modal('show')
            });
        </script>
    @endif
    @if (session('trigger_verify_email'))
        <script>
            $(document).ready(function() {
                Vue.swal({
                    icon: 'error',
                    title: 'Verify Email',
                    text: 'Please verify email before proceeding.',
                    footer: '<a href="#" id="resend_verification_link">Resend new verification link.</a>'
                });
            });
        </script>
    @endif
    <script>
        $(document).on('click', '#resend_verification_link', function() {
            event.preventDefault();
            document.getElementById('email-verification-form').submit();
        });

        $(document).on('click', '.on_mobile_nav_close', function() {
            event.preventDefault();
            $('body').removeClass('mmenu-active');
            $('.menu-toggler').removeClass('active');
        })
    </script>
@endpush
