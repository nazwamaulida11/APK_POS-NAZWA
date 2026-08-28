
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        @vite(['resources/css/app.css','resources/js/app.js'])

        <style>
        .navbar-nav .nav-link.active {
            text-decoration: underline;
            text-decoration-thickness: 2px;
            text-underline-offset: 8px;
            font-weight: 600;
            color: #2c3e50 !important;
        }
        </style>
    </head>
    <body>

        @auth
            @include('layouts.navbar')
        @endauth

        <div class="container">

            @if (session('success'))
                <div class="alert" style="background-color:#e6ecfa; color:#2b3990; border:1px solid #4a63c4; border-radius:4px; padding:10px 16px; margin:12px auto; max-width:400px; text-align:center;">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </body>
</html>