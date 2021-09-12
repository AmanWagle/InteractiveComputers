<!DOCTYPE html>
<html lang="en">

<!-- molla/index-13.html  22 Nov 2019 09:59:06 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- For SEO --}}
    {!! SEO::generate() !!}

    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('website/css/app.css') }}">

</head>

<body>
    <div id="app" class="page-wrapper">

        @include('website.partials.navbar')

        <main class="main">

            @yield('content')

        </main>

        @include('website.partials.footer')

        @guest
            @include('website.auth.auth-modal')
        @endguest

    </div>
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <div class="mobile-menu-overlay"></div>

    @include('website.partials.mobile-menu')

    <script src="{{ asset('website/js/app.js') }}"></script>

    @stack('script')
</body>

</html>
