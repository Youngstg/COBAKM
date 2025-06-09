@section('title', 'Website KM ITERA | Saidata')
<x-client>
    <main class="overflow-hidden">
        <!-- jumbotron kurang logo saidata-->
        <div class="lg:flex items-center">
            <!-- jumbotron -->
            <section id="jumbotron" class="items-center mx-auto bg-cover lg:flex-1">
                <img src="{{ asset('assets/images/saidata/SAIDATA TYPEFACE.png') }}"
                    class="mx-auto px-14 py-12 md:py-16 md:my-auto md:w-1/2 " alt="logo">
            </section>
            <!-- tentang kami -->
            <section id="tentang-saidata"
                class="lg:flex-1 bg-beranda rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-80 border border-gray-100/40 lg:h-full mx-6">
                <article class="h-1/2 flex justify-center align-top text-lg md:text-xl lg:text-2xl md:py-5 lg:h-full">
                    <div class=" h-3/4 lg:h-full p-4 md:pt-4 lg:py-5">
                        <p class="text-neutral-100">
                            SAIDATA merupakan platform yang dikembangkan KM ITERA guna mewadahi informasi berupa riset,
                            beasiswa, dan arsip publik sebagai bentuk digitalisasi data.
                        </p>
                    </div>
                </article>
            </section>
        </div>
        <!-- beasiswa-mobile-tablet ready-->
        <section id="Mobile-Beasiswa" class="h-3/4 lg:hidden">
            <!-- header -->
            <div class="flex flex-col px-5 content-center">
                <h2 class="text-center my-2 text-xl font-bold leading-relaxed tracking-wider text-white">Beasiswa
                </h2>
                <a href="/saidata/beasiswa"
                    class="inline-block bg-yellow-100 py-2 px-1 rounded-md
                shadow shadow-yellow-950 w-2/3 mx-auto text-center my-2 text-white tracking-wide hover:-translate-y-1 hover:shadow hover:drop-shadow-lg">
                    Lihat
                </a>
            </div>
            <!-- card carousel mobile-tablet -->
            <div
                class="flex flex-col gap-4 px-5 mx-auto h-80 overflow-y-scroll scroll-smooth carousel-card my-10 justify-items-center">
                @foreach ($bsws as $bsw)
                    <a href="/saidata/beasiswa/{{$bsw->slug_bsw}}">
                        <div class="h-32 relative flex justify-start w-full pr-7 bg-custom-blue rounded-2xl">
                            <img src="{{ asset('storage/' . $bsw->gambar_bsw) }}" alt=""
                                class="h-full box-border rounded-xl w-full object-cover">
                            <p class="absolute bottom-0 font-bold text-neutral-white m-5 text-sm md:text-base lg:text-lg">
                                {{ $bsw->judul_bsw }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        <!-- beasiswa-desktop ready-->
        <section id="Desktop-Beasiswa" class="hidden lg:flex lg:h-[600px] w-full">
            <!-- header -->
            <div class="w-2/5 flex flex-col justify-center mx-24">
                <h1 class="align-middle text-center text-4xl text-neutral-white">Beasiswa</h1>
                <a href="/saidata/beasiswa"
                    class="inline-block bg-yellow-100 py-2 px-1 rounded-md
                shadow shadow-yellow-950 w-2/3 mx-auto text-center my-2 text-white hover:-translate-y-1 hover:shadow hover:drop-shadow-lg">
                    Lihat
                </a>
            </div>
            <!-- card-carousel dektop -->
            <swiper-container class="mySwiper h-80 w-72 my-auto" effect="cards" grab-cursor="true">
                @foreach ($bsws as $bsw)
                    <swiper-slide
                        class="flex items-center justify-center rounded-2xl text-lg text-black-100 bg-yellow-100 pb-5 border-solid border-2 border-black"
                        id="{{ $loop->iteration }}">
                        <a href="/saidata/beasiswa/{{$bsw->slug_bsw}}">
                            <figure class="image-container bg-white rounded-xl w-full h-full">
                                <img src="{{ asset('storage/' . $bsw->gambar_bsw) }}" alt="" class="mx-auto pb-20 pt-6">
                                <h1 class="text-center text-2xl">{{ Str::limit($bsw->judul_bsw, 20) }}</h1>
                            </figure>
                        </a>
                    </swiper-slide>
                @endforeach
            </swiper-container>
        </section>
        <!-- sebaran-mobile-tablet ready-->
        <section id="Mobile-Sebaran" class="h-3/4 lg:hidden">
            <!-- header -->
            <div class="flex flex-col px-5 content-center">
                <h2 class="text-center my-2 text-xl font-bold leading-relaxed tracking-wider text-white">Sebaran Alumni
                </h2>
                <a href="/saidata/kp"
                    class="inline-block bg-yellow-100 py-2 px-1 rounded-md
                shadow shadow-yellow-950 w-2/3 mx-auto text-center my-2 text-white tracking-wide hover:-translate-y-1 hover:shadow hover:drop-shadow-lg">
                    Lihat
                </a>
            </div>
            <!-- content -->
            <div
                class="flex flex-col gap-4 px-5 mx-auto h-80 overflow-y-scroll scroll-smooth carousel-card my-10 justify-items-center">
                @foreach ($alis as $ali)
                    <a href="">
                        <div class="h-32 relative flex justify-start w-full pl-7 bg-yellow-100 rounded-2xl">
                            <img src="{{ asset('storage/' . $ali->foto_ali) }}" alt="Foto Sebaran"
                                class="h-full box-border rounded-xl w-full object-cover">
                            <p class="absolute bottom-0 font-bold text-neutral-white m-5 text-sm md:text-base lg:text-lg">
                                {{ $ali->nama_ali }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        <!-- sebaran-desktop ready-->
        <section id="Desktop-Beasiswa" class="hidden lg:flex lg:h-[600px]  w-full">
            <!-- card-carousel-dektop -->
            <swiper-container class="mySwiper h-80 w-72 my-auto" effect="cards" grab-cursor="true">
                @foreach ($alis as $ali)
                    <swiper-slide
                        class="flex items-center justify-center rounded-2xl text-lg text-black-100 bg-custom-blue pb-4 border-solid border-2 border-black"
                        id="{{ $loop->iteration }}">
                        <figure class="image-container bg-white rounded-xl w-full h-full">
                            <img src="{{ asset('storage/' . $ali->foto_ali) }}" alt="" class="mx-auto pb-20 pt-6">
                            <h1 class="text-center text-2xl">{{ Str::limit($ali->nama_ali, 20) }}</h1>
                        </figure>
                    </swiper-slide>
                @endforeach
            </swiper-container>
            <!-- header -->
            <div class="w-2/5 flex flex-col justify-center mx-24">
                <h1 class="align-middle text-center text-4xl text-neutral-white">Sebaran Alumni</h1>
                <a href="/saidata/alumni"
                    class="inline-block bg-yellow-100 py-2 px-1 rounded-md
                shadow shadow-yellow-950 w-2/3 mx-auto text-center my-2 text-white tracking-wide hover:-translate-y-1 hover:shadow hover:drop-shadow-lg">
                    Lihat
                </a>
            </div>

        </section>
        <!-- arsip-mobile ready-->
        <section id="Mobile-Alumni" class="h-3/4 lg:hidden">
            <!-- header -->
            <div class="flex flex-col px-5 content-center">
                <h2 class="text-center my-2 text-xl font-bold leading-relaxed tracking-wider text-white">
                    Arsip
                </h2>
                <a href="/saidata/arsip"
                    class="inline-block bg-yellow-100 py-2 px-1 rounded-md
                    shadow shadow-yellow-950 w-2/3 mx-auto text-center my-2 text-white tracking-wide hover:-translate-y-1 hover:shadow hover:drop-shadow-lg">
                    Lihat
                </a>
            </div>

            <!-- content -->
            <div
                class="flex flex-col gap-4 px-5 mx-auto h-80 overflow-y-scroll scroll-smooth carousel-card my-10 justify-items-center">
                @foreach ($sai as $sai)
                    <a href="#">
                        <div class="h-32 relative flex justify-start w-full pr-7 bg-black-50 rounded-2xl">
                            <img src="{{ asset('storage/' . $sai->logo_sai) }}" alt=""
                                class="h-full box-border rounded-xl w-full object-cover">
                            <p class="absolute bottom-0 font-bold text-neutral-white m-5 text-sm md:text-base lg:text-lg">
                                {{ $sai->judul_sai }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        <!-- Arsip-Desktop ready-->
        <section id="Desktop-Beasiswa" class="hidden lg:flex lg:h-[600px] w-full">
            <!-- header -->
            <div class="w-2/5 flex flex-col justify-center mx-24">
                <h1 class="align-middle text-center text-4xl text-neutral-white">Arsip</h1>
                <a href="/saidata/arsip"
                    class="inline-block bg-yellow-100 py-2 px-1 rounded-md
                shadow shadow-yellow-950 w-2/3 mx-auto text-center my-2 text-white hover:-translate-y-1 hover:shadow hover:drop-shadow-lg">
                    Lihat
                </a>
            </div>
            <!-- card-carousel dektop -->
            <swiper-container class="mySwiper h-80 w-72 my-auto" effect="cards" grab-cursor="true">
                @foreach ($sai as $sais)
                    <swiper-slide
                        class="flex items-center justify-center rounded-2xl text-lg text-black-100 bg-black-75 pb-4 border-solid border-2 border-black"
                        id="{{ $loop->iteration }}">
                        <figure class="image-container bg-white rounded-xl w-full h-full">
                            <img src="{{ asset('storage/' . $sai->logo_sai) }}" alt="" class="mx-auto pb-20 pt-6">
                            <h1 class="text-center text-2xl">{{ Str::limit($sai->judul_sai, 20) }}</h1>
                        </figure>
                    </swiper-slide>
                @endforeach
            </swiper-container>
        </section>
        <!-- Riset -->
        <section class="mx-2">
            <div class="border-2 border-yellow-100 rounded-lg md:w-3/4 mx-auto">
                <h1 class="align-middle text-center text-4xl text-white leading-relaxed tracking-wider font-bold py-5">
                    Riset
                </h1>
                <div class="owl-carousel owl-theme pb-10">
                    @foreach ($penristeks as $penristek)
                        <div class="item mx-5 425:mx-10 600:mx-2 800:mx-8 lg:mx-10">
                            <h3 class="bg-gray-500 rounded-lg align-middle text-center text-lg text-white my-5 mx-10 py-2">
                                {{ $penristek->tgl_up }}
                            </h3>
                            <a href="{{ $penristek->link_penristek }}" target="blank">
                                <div class="bg-black-75 rounded-lg">
                                    <figure class="rounded-lg mx-auto p-5 425:p-8 600:p-3 ">
                                        <img src="{{ asset('storage/' . $penristek->gambar) }}" alt="" srcset=""
                                            class=" rounded-lg object-cover max-w-md mx-auto aspect-video   ">
                                    </figure>
                                    <div class="pb-5">
                                        <h1
                                            class="align-middle text-center text-lg font-bold text-white leading-relaxed tracking-wider mb-5 mx-10 lg:text-2xl xl:text-4xl">
                                            {{ $penristek->judul }}
                                        </h1>
                                        <div
                                            class="align-middle text-center text-lg text-white leading-relaxed tracking-wider lg:text-xl">
                                            {!! Str::limit($penristek->deskripsi, 100) !!}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</x-client>

@section('script')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
<!-- script carousel -->
{{--
<script src="{{ asset('assets/js/carousel.js') }}"></script> --}}
<!-- owl-carousel CDN-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            }
        }
    })
</script>
@endsection
