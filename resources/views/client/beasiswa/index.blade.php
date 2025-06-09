@section('title', 'Website KM ITERA | Beasiswa')

<x-client>
    <main class="text-white align-middle py-10">
        <h1
            class="text-center text-2xl font-bold leading-relaxed tracking-wider md:text-4xl md:py-10 lg:py-16 xl:text-6xl xl:py-20">
            Beasiswa
        </h1>

        <section id="Mobile-Beasiswa" class="h-3/4 lg:hidden">
            <!-- card carousel mobile-tablet -->
            <div class="flex flex-col gap-4 px-2 mx-auto carousel-card my-10 justify-items-center max-w-md">
                @foreach ($bsws as $bsw)
                    <a href="/saidata/beasiswa/{{ $bsw->slug_bsw }}">
                        <div class="h-32 relative flex justify-start w-full pr-7 bg-gray-400 rounded-2xl">
                            @if ($bsw->gambar_bsw)
                                <img src="{{ asset('storage/' . $bsw->gambar_bsw) }}"
                                    class="relative w-full rounded-xl object-cover">
                            @else
                                <img src="{{ asset('assets/images/No_img_horizontal.png') }}"
                                    class="relative w-full rounded-xl object-cover">
                            @endif
                            <p
                                class="absolute bottom-0 font-bold text-neutral-white m-5 text-sm md:text-base lg:text-lg px-2">
                                {{ $bsw->judul_bsw }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <article class="hidden lg:grid lg:grid-cols-4 mx-2 my-3">
            @foreach ($bsws as $bsw)
                <a id="{{ $loop->iteration }}" href="/saidata/beasiswa/{{ $bsw->slug_bsw }}">
                    <button class="font-bold my-2 mx-2 rounded-lg text-left lg:pb-3 hover:translate-y-1 duration-500">
                        <div class="flex md:block rounded-lg bg-white ">
                            <div class="w-1/2 md:w-full h-auto md:h-full">
                                @if ($bsw->gambar_bsw)
                                    <img src="https://drive.google.com/uc?export=view&id={{ $bsw->gambar_bsw }}"
                                        class="relative rounded-t-lg object-cover">
                                @else
                                    <img src="{{ asset('assets/images/No_img_horizontal.png') }}"
                                        class="relative rounded-t-lg object-cover">
                                @endif
                            </div>
                            <div class="w-full grid bg-gray-400 pb-3 rounded-b-lg">
                                <div class="w-full bg-white px-5 py-3 rounded-b-lg">
                                    <h2 class="text-xl text-black-100 py-2">{{ $bsw->judul_bsw }}</h2>
                                    <h5 class="text-black-100">
                                        {!! Str::limit($bsw->konten_bsw, 80) !!}
                                        <span class="text-blue-500 hover:text-blue-800">
                                            Read more
                                        </span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </button>
                </a>
            @endforeach
        </article>
    </main>
</x-client>
