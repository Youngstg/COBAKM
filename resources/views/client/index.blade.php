@section('title', 'KM-ITERA Official Website | Keluarga Mahasiswa Institut Teknologi Sumatera')

<x-client>
    <main class="text-gasendra-blue-primary">
        <!-- jumbotron -->
        <section id="jumbotron"
            class="relative bg-primary-beranda bg-no-repeat bg-cover bg-bottom md:bg-cover md:bg-right md:flex mb-5 overflow-hidden m-[14px] rounded-[20px]">
            <!-- Logo -->
            <div class="md:w-[50%] lg:w-[40%] lg:min-w-56">
                @foreach ($logos as $logo)
                    <img src="{{ asset($logo->logo_kbt) }}"
                        class="relative z-10 mx-auto scale-75 transform transition duration-500 hover:scale-80 hover:rotate-3"
                        alt="logo">
                @endforeach
            </div>
            <!-- Text and Buttons -->
            <div
                class="relative z-10 text-center md:my-auto -mt-5 px-6 pb-8 lg:px-10 mx-5 lg:mx-10 transform transition duration-500 lg:max-w-4xl">
                <h1 class="font-medium leading-relaxed px-3 md:mb-6 lg:mb-10 mb-8 animate-fade-in-up">
                    <p class="lg:text-5xl text-2xl">Selamat Datang di Official Website</p>
                    <span class="font-bold lg:text-7xl text-4xl">KABINET KM-ITERA</span>
                </h1>
                <div class="flex flex-col md:block">
                    <a href="#kabar"
                        class="transition-all w-3/4 mx-auto md:w-auto bg-gasendra-yellow-primary uppercase py-2 lg:py-3 lg:text-base md:text-sm lg:px-10 md:px-5 rounded-3xl md:mr-2 lg:mr-6 mt-3 text-neutral-100 cursor-pointer hover:drop-shadow-2xl hover:shadow-lg">
                        Aktivitas KM
                    </a>
                    <a href="/ekraf"
                        class="transition-all w-3/4 mx-auto md:w-auto bg-gasendra-yellow-primary uppercase py-2 lg:py-3 lg:text-base md:text-sm lg:px-10 md:px-5 rounded-3xl mt-3 text-neutral-100 cursor-pointer hover:drop-shadow-2xl hover:shadow-lg">
                        E-Commerce
                    </a>
                </div>
            </div>
        </section>

        <!-- tentang kami -->
        <section id="tentang-kami" class="md:h-1/2 md:grid md:grid-cols-2 px-8 gap-6" data-aos="fade-up"
            data-aos-duration="1500">
            <article class="text-lg md:text-xl lg:text-2xl lg:my-auto">
                <div class="bg-transparant h-full rounded-lg py-4 md:pt-4">
                    <h3
                        class="lg:text-6xl md:text-3xl lg:pr-10 text-2xl text-center md:text-left font-bold pb-5 text-gasendra-blue-primary">
                        KELUARGA MAHASISWA ITERA</h3>
                    <p class="text-black-100 text-justify text-sm md:text-base xl:text-xl xl:leading-relaxed px-1">
                        Website KM-ITERA merupakan platform untuk digitalisasi informasi serta pengenalan terhadap
                        profile dari Keluarga Mahasiswa ITERA.
                        Memberikan informasi baik internal maupun eksternal KM-ITERA kepada civitas akademika ITERA dan
                        masyarakat umum.
                    </p>
                </div>
            </article>
            <figure class="content-center md:py-auto py-6 md:px-5">
                <iframe src="https://www.youtube.com/embed/8OxTG8plkz4" class="aspect-video w-full rounded-2xl mx-auto"
                    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; web-share"></iframe>
            </figure>
        </section>
        <!-- kabar -->
        <section id="kabar" class="lg:py-10 py-6" data-aos="fade-up" data-aos-duration="1500">
            <!-- header -->
            <div class="mx-6 md:px-6 my-2 lg:my-5">
                <div class="flex justify-between pl-2">
                    <h2 class="text-start text-xl font-semibold text-gasendra-blue-primary md:text-2xl lg:text-4xl">
                        Kabar dari KM-ITERA
                    </h2>
                    <a href="/artikel"
                        class="text-end text-md text-black-100 lg:text-white lg:bg-gasendra-yellow-primary md:rounded-2xl md:px-4 md:py-1 cursor-pointer md:text-xl font-semibold my-auto no-underline">Lihat</a>
                </div>
            </div>
            <!-- carousel -->
            <div class="owl-carousel px-5 lg:py-5 py-3" id="kabar-carousel">
                @foreach ($atks as $atk)
                    <a href="artikel/{{ $atk->slug_atk }}" class="hover:mix-blend-soft-light">
                        <div class="item relative lg:h-2/3 object-cover">
                            @if ($atk->gambar_atk != null)
                                <img src="{{ asset('storage/' . $atk->gambar_atk) }}"
                                    class="relative rounded-xl lg:mx-3 object-fill h-60 lg:h-80 max-md:h-44">
                            @else
                                <img src="{{ asset('assets/images/No_img_horizontal.png') }}"
                                    class="relative rounded-xl lg:mx-3 object-fill h-60 lg:h-80 max-md:h-44">
                            @endif
                            <div
                                class="bg-slate-600/75 absolute translate-x-3 bottom-7 p-1 rounded-br-xl rounded-tr-xl">
                                <p class="font-bold text-neutral-white text-sm md:text-base lg:text-lg">
                                    {{ Str::limit($atk->judul_atk, 20) }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        <!-- activities -->
        <section id="activities" class="lg:py-10 py-6" data-aos="fade-up" data-aos-duration="1500">
            <!-- header -->
            <div class="mx-6 md:px-6 my-2 lg:my-5">
                <div class="flex justify-between pl-2">
                    <h2 class="text-start text-xl font-semibold text-gasendra-blue-primary md:text-2xl lg:text-4xl">
                        Event KM-ITERA
                    </h2>
                    <a href="/activity"
                        class="text-end text-md text-black-100 lg:text-white lg:bg-gasendra-yellow-primary md:rounded-2xl md:px-4 md:py-1 cursor-pointer md:text-xl font-semibold my-auto no-underline">Lihat</a>
                </div>
            </div>
            <!-- carousel -->
            <div class="owl-carousel px-5 lg:py-5 py-3" id="activity-carousel">
                @foreach ($activities as $activity)
                    <a href="activity/{{ $activity->slug_kmac }}" class="hover:mix-blend-soft-light">
                        <div class="item relative lg:h-2/3 object-cover">
                            @if ($activity->gambar_kmac != null)
                                <img src="{{ asset("storage/$activity->gambar_kmac") }}"
                                    class="relative rounded-xl lg:mx-3 object-fill w-max h-60 lg:h-80 max-md:h-44">
                            @else
                                <img src="{{ asset('assets/images/No_img_horizontal.png') }}"
                                    class="relative rounded-xl lg:mx-3 w-max h-60 lg:h-80 max-md:h-44 object-fill">
                            @endif
                            <div
                                class="bg-slate-600/75 absolute translate-x-3 bottom-7 p-1 rounded-br-xl rounded-tr-xl">
                                <p class="font-bold text-neutral-white text-sm md:text-base lg:text-lg">
                                    {{ Str::limit($activity->title_kmac, 20) }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        <!-- podcasts -->
        <section id="podcasts" class="lg:py-10 py-6" data-aos="fade-up" data-aos-duration="1500">
            <div class="mx-6 md:px-6 my-2 lg:my-5">
                <div class="flex justify-between pl-2 mb-4">
                    <h2 class="text-start text-xl font-semibold text-gasendra-blue md:text-2xl lg:text-4xl">
                        Podcast KM
                    </h2>
                </div>
                <!-- carousel -->
                <div class="relative pb-12">
                    <div class="swiper header-carousel">
                        <div class="swiper-wrapper">
                            @foreach ($featuredPodcasts as $podcast)
                                <div class="swiper-slide">
                                    <a href="/podcasts/{{ $podcast->slug }}" class="hover:mix-blend-soft-light block">
                                        <div class="relative aspect-video">
                                            @if ($podcast->thumbnail !== null)
                                                <img src="{{ asset('storage/' . $podcast->thumbnail) }}"
                                                    class="rounded-xl object-cover w-full h-full">
                                            @else
                                                <img src="{{ asset('public/assets/images/No_img_horizontal.png') }}"
                                                    class="rounded-xl object-cover w-full h-full">
                                            @endif
                                            <div
                                                class="bg-slate-600/75 absolute left-0 bottom-0 p-2 rounded-br-xl rounded-bl-xl w-full">
                                                <p class="font-bold text-neutral-white text-sm md:text-base">
                                                    {{ Str::limit($podcast->judul, 20) }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="text-center mt-6">
                    <a href="/podcasts"
                        class="bg-gasendra-yellow-primary text-white px-6 py-2 rounded-full font-semibold">Lihat
                        semua</a>
                </div>
            </div>
        </section>
        <!-- ormawa -->
        <section id="ormawa" class="lg:py-10 py-6" data-aos="fade-up" data-aos-duration="1500">
            <!-- carousel -->
            <div class="owl-carousel px-2 md:px-5 lg:py-5 py-3" id="ormawa-carousel">
                @foreach ($ormawas as $ormawa)
                    @if ($ormawa != null)
                        <a href="{{ $ormawa->website ? $ormawa->website : $ormawa->instagram }}">
                            <img src="{{ asset('storage/' . $ormawa->image) }}"
                                class="relative lg:w-20 lg:h-36 object-contain">
                        </a>
                    @else
                        <div>Konten tidak tersedia!</div>
                    @endif
                @endforeach
            </div>
        </section>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#kabar-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            touchDrag: true,
            autoplay: true,
            autoplayTimeout: 2500,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                }
            }
        })
    </script>
    <script>
        $('#ormawa-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            touchDrag: true,
            autoplay: true,
            autoplayTimeout: 1000, // waktu berhenti sangat kecil
            autoplaySpeed: 3000, // kecepatan bergerak lebih lambat untuk memberikan efek mengalir
            smartSpeed: 2000,
            autoplayHoverPause: true, // tidak berhenti saat hover
            slideTransition: 'linear', // transisi linear untuk pergerakan halus
            responsive: {
                0: {
                    items: 3
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 6
                },
            }
        });
    </script>
    <script>
        $('#activity-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            touchDrag: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
    <script>
        new Swiper('.header-carousel', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            slidesPerView: 1,
            spaceBetween: 20,
            centeredSlides: true,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    centeredSlides: false,
                },
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                renderBullet: function(index, className) {
                    return `<span class="${className} bg-gasendra-yellow-primary mx-1 inline-block w-2 h-2 rounded-full"></span>`;
                },
            },
        });
    </script>
</x-client>
