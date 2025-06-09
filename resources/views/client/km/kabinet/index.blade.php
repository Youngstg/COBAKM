<x-client class="">
    <style>
        .swiper-button-prev,
        .swiper-button-next {
            background-image: none !important;
            height: 3rem;
            width: 3rem;

            &::after {
                display: none !important;
            }
        }
    </style>
    <div class="jumbotron h-[35%] m-4 rounded-xl bg-primary-beranda bg-cover bg-bottom bg-no-repeat">
        <div class="flex flex-col lg:flex-row justify-center h-full py-10 px-3 md:px-10 lg:px-16 items-center ">
            <div class="lg:hidden uppercase flex flex-col text-gasendra-blue text-center">
                <span class="text-3xl md:text-[64px] leading-none">Kabinet</span>
                <span class="text-3xl md:text-7xl font-bold leading-none">{{ $kbt->nama_kbt }}</span>
                <span class="text-md md:text-[36px] leading-tight">Masa Bakti
                    {{ $kbt->tahun_kbt }}/{{ $kbt->tahun_kbt + 1 }}</span>
            </div>
            <div class="lg:w-2/5 md:w-3/4 w-full h-full flex justify-center items-center">
                <!-- Swiper -->
                <div class="swiper-container my-swiper h-[22rem] md:h-[30rem] relative overflow-hidden w-[32rem] lg:w-[32rem] bg-contain bg-no-repeat bg-center"
                    style="background-image: url('{{ asset('assets/images/new/carouselBackground.png') }}');">
                    <div class="swiper-wrapper">
                        @foreach ($kbts as $kbtSlide)
                            <div class="swiper-slide" data-slug="{{ $kbtSlide->slug_kbt }}"
                                data-year="{{ $kbtSlide->tahun_kbt }}">
                                @if ($kbtSlide->logo_kbt != null)
                                    <img src="{{ asset($kbtSlide->logo_kbt) }}" class="w-[55%] h-full mx-auto object-contain"
                                        alt="">
                                @else
                                    <img src="{{ asset('assets/images/logo/LogoKM-HD.png') }}"
                                        class="mx-auto h-full object-contain" alt="" style="width: 35%;">
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Pagination -->
                    <div class="swiper-pagination "></div>
                    <!-- Add Navigation -->
                    <div class="swiper-button-prev bg-gasendra-mustard rounded-full mr-4 md:ml-5">
                        <i class="fa-solid fa-chevron-left text-white text-2xl md:text-3xl"></i>
                    </div>
                    <div class="swiper-button-next bg-gasendra-mustard rounded-full ml-4 md:mr-5">
                        <i class="fa-solid fa-chevron-right text-white text-2xl md:text-3xl"></i>
                    </div>
                </div>
            </div>
            <div class="text-gasendra-blue flex flex-col w-full lg:w-2/3 md:px-4">
                <div class="hidden lg:flex">
                    <div class="uppercase flex flex-col">
                        <span class="text-3xl lg:text-[64px] leading-none">Kabinet</span>
                        <span class="text-5xl lg:text-[5.5rem] font-bold leading-none">{{ $kbt->nama_kbt }}</span>
                        <span class="text-md lg:text-xl leading-tight">Masa Bakti
                            {{ $kbt->tahun_kbt }}/{{ $kbt->tahun_kbt + 1 }}</span>
                    </div>
                </div>
                <div class="header-text relative">
                    <p
                        class="bg-white/10 md:text-lg border-2 border-white text-justify rounded-xl p-5  text-black mt-2 md:mt-4">
                        {{ $kbt->desk_kbt }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <section class="department my-10 flex justify-center rounded-lg overflow-hidden md:mx-8 mx-4" data-aos="fade-up"
        data-aos-duration="1500">
        @if ($kbt->foto_kbt != null)
            <a href="javascript:void(0)"
                onclick="openModal('{{ file_exists(public_path($kbt->foto_kbt)) ? asset($kbt->foto_kbt) : asset('assets/images/No_img_horizontal.png') }}')">
                <img src="{{ file_exists(public_path($kbt->foto_kbt)) ? asset($kbt->foto_kbt) : asset('assets/images/No_img_horizontal.png') }}"
                    alt="">
            </a>
        @else
            <h1 class="text-4xl font-bold"> Belum Ada Organigram </h1>
        @endif
    </section>

    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-white overflow-scroll">
        <span
            class="fixed bg-white inset-x-0 top-0 px-2 md:py-5 flex justify-end md:px-5 lg:px-10 text-slate-700 text-4xl font-bold transition-colors duration-300 hover:text-slate-900 cursor-pointer"
            onclick="closeModal()">&times;</span>
        <img class="mx-auto block w-[95%] mt-12 md:mt-20" id="modalImage">
    </div>

</x-client>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var initialSlideIndex = {{ $currentIndex }};
    var swiper = new Swiper('.my-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        initialSlide: initialSlideIndex,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 1,
            renderBullet: function (index, className) {
                return '<span class="' + className + '"></span>';
            }
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    function navigateToSlide(slideIndex) {
        var activeSlide = swiper.slides[slideIndex];
        var slug = activeSlide.getAttribute('data-slug');
        var year = activeSlide.getAttribute('data-year');
        if (slug) {
            window.location.href = '/kabinet/' + slug + '?slideIndex=' + slideIndex + '&tahun=' + year;
        }
    }

    document.querySelector('.swiper-button-next').addEventListener('click', function () {
        setTimeout(() => {
            navigateToSlide(swiper.activeIndex);
        }, 300);
    });

    document.querySelector('.swiper-button-prev').addEventListener('click', function () {
        setTimeout(() => {
            navigateToSlide(swiper.activeIndex);
        }, 300);
    });

    // Handle pagination click
    document.querySelectorAll('.swiper-pagination .swiper-pagination-bullet').forEach(function (bullet, index) {
        bullet.addEventListener('click', function () {
            setTimeout(() => {
                navigateToSlide(index);
            }, 300);
        });
    });

    function openModal(imageSrc) {
        var modal = document.getElementById("imageModal");
        var modalImage = document.getElementById("modalImage");

        modal.style.display = "block";
        modalImage.src = imageSrc || '{{ asset('assets/images/No_img_horizontal.png') }}';
    }

    // Close the Modal
    function closeModal() {
        var modal = document.getElementById("imageModal");
        modal.style.display = "none";
    }
</script>