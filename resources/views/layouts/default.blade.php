<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
    @stack('head')
</head>

<body>
    <div id="app">
        @include('layouts.header')
        @stack('header')

        <div class="row m-5 h-100">
            @include('layouts.menu')
            @stack('menu')
            <div class="col-6 w-75">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="page-footer font-small text-bg-dark p-3">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">
            <p>PHP training by LIFETIME technologies</p>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
</body>

</html>
