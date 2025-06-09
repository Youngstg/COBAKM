<style>
    .km-desc h1,
    .km-desc h2,
    .km-desc h3,
    .km-desc h4,
    .km-desc h5,
    .km-desc h6,
    .km-desc p {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        /* Jumlah baris yang diinginkan */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }



    .card {
        transition: transform 0.3s ease, filter 0.3s ease;
    }

    .card:nth-child(1) {
        left: 0;
    }

    .card:nth-child(2) {
        left: 170px;
    }

    .card:nth-child(3) {
        left: 340px;
    }

    @media screen and (max-width: 768px) {
        .card:nth-child(1) {
            left: 0;
        }

        .card:nth-child(2) {
            left: 70px;
        }

        .card:nth-child(3) {
            left: 140px;
        }

        #deskripsi h1,
        #deskripsi h2,
        #deskripsi h3,
        #deskripsi h4,
        #deskripsi h5 {
            font-weight: 600;
            font-size: 18px;
        }
    }

    .card.blurred {
        filter: blur(3px);
    }

    #deskripsi h1,
    #deskripsi h2,
    #deskripsi h3,
    #deskripsi h4,
    #deskripsi h5 {
        font-weight: 600;
        font-size: 25px;
    }
</style>
<x-client>
    <main class="">
        <section
            class="h-96 md:h-80 bg-primary-beranda flex justify-center items-center bg-no-repeat bg-bottom bg-cover aspect-square w-full">
            <h1
                class="text-gasendra-blue-primary text-3xl md:text-4xl lg:text-6xl leading-relaxed px-5 font-semibold py-[8rem] md:py-[6rem] lg:py-[5.5rem] uppercase">
                Event KM ITERA
            </h1>
        </section>
        <section
            class="lg:px-14 pb-20 md:px-10 px-6 bg-white md:rounded-s-3xl rounded-xl md:-my-10 -mt-8 z-auto overflow-hidden">
            <article
                class="relative md:inset-x-10 md:flex mx-auto lg:h-[26rem] md:h-[22.5rem] md:top-14 max-w-7xl hidden">
                @foreach ($nears as $near)
                    <div class="card bg-white hover:scale-105 hover:z-10 hover:-top-4 absolute lg:w-[17rem] md:w-[14rem] lg:rounded-2xl md:rounded-xl overflow-hidden border-2 border-gray-200 p-3 flex gap-4 flex-col cursor-pointer"
                        data-description='<div id="deskripsi">{{ $near->deskripsi_kmac }}</div>'>
                        <a href="/activity/{{ $near->slug_kmac }}">
                            <figure>
                                @if ($near->gambar_kmac != null)
                                    <img class="lg:h-40 md:h-28 w-full mb-3" src="{{ asset("storage/$near->gambar_kmac") }}"
                                        alt="{{ $near->title_kmac }}">
                                @else
                                    <img class="lg:h-40 md:h-28 w-full mb-3 object-contain"
                                        src="{{ asset('assets/images/No_img_horizontal.png') }}" alt="">
                                @endif
                                <div class="md:grid md:grid-cols-2 md:gap-2">
                                    @foreach ($near->tags as $tag)
                                        <h5
                                            class="rounded-2xl px-2 py-1 border border-gasendra-blue-primary w-full text-center lg:text-sm md:text-xs">
                                            {{ $tag->nama_tag }}
                                        </h5>
                                    @endforeach
                                </div>
                            </figure>
                        </a>
                        <div>
                            <div class="md:text-sm lg:text-lg km-desc">
                                {!! $near->deskripsi_kmac !!}
                            </div>
                            <div class="mt-6">
                                @if ($near->ketuplak_kmac)
                                    <p class="flex gap-3 items-center">
                                        <i class="fa-regular fa-user"></i>
                                        <span class="line-clamp-1">{{ $near->ketuplak_kmac }}</span>
                                    </p>
                                @endif
                                <p class="flex gap-3 items-center">
                                    <i class="fa-regular fa-calendar"></i>
                                    <span>{{ $near->formatted_date }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="description-container absolute top-32 {{ isset($near) && $near->count() >= 3 ? 'lg:left-[53%] md:left-[58%]' : 'lg:left-[40%] md:left-[50%]' }} lg:w-[28rem] md:w-60 px-2"
                    data-desc="<h3 class='md:text-3xl lg:text-5xl uppercase font-normal text-gasendra-blue'>Event terdekat <span class='font-bold'>KM
                            ITERA</span></h3>
                    ">

                    <h3 class='md:text-3xl lg:text-5xl uppercase font-normal text-gasendra-blue'>Event terdekat <span
                            class="font-bold">KM
                            ITERA</span></h3>
                    <!-- <p>Berikut adalah 3 Event yang sebentar lagi akan dilaksanakan</p> -->
                </div>
            </article>

            <article class="md:max-w-7xl md:mt-12 mt-10 mx-auto max-w-sm">
                <div class="w-full py-3 text-center bg-gasendra-yellow-primary bg-opacity-10 rounded-md md:mb-12 mb-8">
                    <h3 class="text-xl uppercase font-semibold text-gasendra-yellow-primary">Semua Event</h3>
                </div>
                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 md:gap-14 md:px-8 lg:px-0 lg:gap-8 gap-5">
                    @foreach ($activities as $activity)
                        <div
                            class="lg:rounded-2xl rounded-xl overflow-hidden border-2 border-gray-200 p-4 flex gap-4 flex-col bg-white hover:scale-105 hover:shadow-lg">
                            <a href="/activity/{{ $activity->slug_kmac }}">
                                <figure>
                                    @if ($activity->gambar_kmac != null)
                                        <img class="lg:h-40 md:h-36 h-44 w-full mb-4"
                                            src="{{ asset("storage/$activity->gambar_kmac") }}"
                                            alt="{{ $activity->title_kmac }}">
                                    @else
                                        <img class="lg:h-40 md:h-36 h-44 w-full mb-4 object-contain"
                                            src="{{ asset('assets/images/No_img_horizontal.png') }}" alt="">
                                    @endif
                                    <div class="md:grid md:grid-cols-2 md:gap-2 flex gap-1">
                                        @foreach ($activity->tags as $tag)
                                            <h5
                                                class="rounded-3xl px-1 py-2 border border-gasendra-blue-primary w-full text-center line-clamp-1 md:text-sm text-xs">
                                                {{ $tag->nama_tag }}
                                            </h5>
                                        @endforeach
                                    </div>
                                </figure>
                                <div>
                                    <div class="md:text-sm lg:text-lg km-desc">
                                        {!! $activity->deskripsi_kmac !!}
                                    </div>
                                    <div class="mt-4">
                                        @if ($activity->ketuplak_kmac)
                                            <p class="flex gap-3 items-center">
                                                <i class="fa-regular fa-user"></i>
                                                <span class="line-clamp-1">{{ $activity->ketuplak_kmac }}</span>
                                            </p>
                                        @endif
                                        <p class="flex gap-3 items-center">
                                            <i class="fa-regular fa-calendar"></i>
                                            <span>{{ $activity->formatted_date }}</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </article>


        </section>
    </main>
    <script>
        const cards = document.querySelectorAll('.card');
        const descriptionContainer = document.querySelector('.description-container');

        cards.forEach(card => {
            card.addEventListener('mouseenter', function () {
                const description = card.getAttribute('data-description');
                descriptionContainer.innerHTML = description;
                descriptionContainer.style.display = 'block';

                cards.forEach(c => {
                    if (c !== card) {
                        c.classList.add('blurred');
                    }
                });
            });

            card.addEventListener('mouseleave', function () {
                const description = descriptionContainer.getAttribute('data-desc');
                // descriptionContainer.style.display = 'none';
                descriptionContainer.innerHTML = description;
                cards.forEach(c => {
                    c.classList.remove('blurred');
                });
            });
        });
    </script>

</x-client>