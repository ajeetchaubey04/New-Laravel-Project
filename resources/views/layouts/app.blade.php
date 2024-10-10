<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')

    @include('layouts.css')
</head>

<body>
    <!-- Start #main -->
    <main class="target_continer">
        @include('partials.loader')
        @include('partials.toast')

        @include('partials.header')

        @yield('intro')

        @yield('content')

        @include('partials.footer')

        @include('partials.cart')

        @yield('modals')
        
    </main>
    <!-- End #main -->
    @include('layouts.js')

</body>

</html>
