<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Interactive Computers</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">

</head>

<body>

    <div id="app">
        {{-- Sidebar --}}
        @include('admin.particals.sidebar')

        <div id="main" class='layout-navbar'>
            {{-- Topbar --}}
            @include('admin.particals.topbar')

            <div id="main-content">
                <div class="page-heading">
                    {{-- Content --}}
                    @yield('content')

                </div>
                {{-- Footer --}}
                @include('admin.particals.footer')
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/js/app.js') }}"></script>

</body>

</html>
