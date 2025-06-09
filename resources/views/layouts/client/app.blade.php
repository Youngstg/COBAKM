<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property='og:title' content='@yield('title')' />
    <meta property='og:description'
        content='Website KM ITERA merupakan platform untuk digitalisasi informasi serta pengenalan terhadap profile dari Keluarga Mahasiswa ITERA' />
    <title>@yield('title')</title>

    @vite('resources/css/app.css')
    <!-- @yield('preloader') -->
    <!-- @section('preloader')
    <link rel="stylesheet" href="{{ asset('assets/css/splasher.css') }}">
    @endsection -->

    @include('layouts.splash')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- owl-carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logoKM_ico.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/scrollBar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/splasher.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    {{--
    <script src="https://cdn.tailwindcss.com"></script> --}}
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    @yield('style')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>

<body class="max-[280px]:hidden overflow-x-hidden w-full font-inter">
    @include('layouts.client.header')
    <div class="max-w-[115rem] mx-auto">
        {{ $slot }}
    </div>
    @include('layouts.client.footer')

    @yield('script')
    <!-- script -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        function Open(target) {
            let e = document.querySelector(target);
            // e.classList.toggle('active')
            if (e.classList.contains("hidden")) {
                e.classList.remove("hidden");
                e.classList.add("block");
            } else {
                e.classList.remove("block");
                e.classList.add("hidden");
            }
        }
    </script>
</body>

</html>