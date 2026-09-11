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

            @yield('content')
        </div>
    </body>
</html>