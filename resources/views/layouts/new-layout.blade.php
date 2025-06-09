<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KM ITERA')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/assets/owl.carousel.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/owlcarousel/assets/owl.theme.default.min.css') }}"> --}}

</head>

<body>
    <main class="mx-auto">
        @yield('content')
    </main>
    <x-ui.footer />
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="{{ asset('assets/owlcarousel/owl.carousel.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
