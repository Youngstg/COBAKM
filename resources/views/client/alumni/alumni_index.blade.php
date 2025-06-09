@section('title', 'Alumni | KM ITERA Official Website')

<x-clinet>
    <main class="text-white align-middle py-10">
        <h1
            class="text-center text-2xl font-bold leading-relaxed tracking-wider md:text-4xl md:py-10 lg:py-16 xl:text-6xl xl:py-20">
            Sebaran Alumni
        </h1>

        <section class="h-3/4 lg:hidden">
            <!-- card carousel mobile-tablet -->
            <div
                class="flex flex-col gap-4 px-5 mx-auto scroll-smooth carousel-card my-10 justify-items-center max-w-md">
                @foreach ($alis as $ali)
                    <a href="">
                        <div class="h-32 relative flex justify-start w-full pl-7 bg-custom-blue rounded-2xl">
                            <img src="{{ asset('storage/' . $ali->foto_ali) }}" alt="Foto Sebaran"
                                class="h-full box-border rounded-xl w-full object-cover">
                            <h2 class="absolute bottom-5 font-bold text-neutral-white m-5 text-sm md:text-base lg:text-lg">
                                {{ $ali->nama_ali }}
                            </h2>
                            <p class="absolute bottom-0 font-bold text-neutral-white m-5 text-sm md:text-base lg:text-lg">
                                Kuliah Praktek {{ $ali->kp_ali }} Pekerjaan {{ $ali->pkj_ali }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="hidden lg:grid lg:grid-cols-4 mx-2 my-3">
            @foreach ($alis as $ali)
                <button class="font-bold my-2 mx-2 rounded-lg text-left lg:pb-3 hover:translate-y-1 duration-500">
                    <div class="flex md:block rounded-lg bg-white ">
                        <div class="w-1/2 md:w-full h-auto md:h-full">
                            <img src="{{ asset('storage/' . $ali->foto_ali) }}" alt="Foto Sebaran"
                                class="h-full box-border rounded-xl w-full object-cover">
                        </div>
                        <div class="w-full grid bg-custom-blue pb-3 rounded-b-lg">
                            <div class="w-full bg-white px-5 py-3 rounded-b-lg">
                                <h2 class="text-xl text-black-100 py-2">{{ $ali->nama_ali }}</h2>
                                <p class="text-black-100">Kuliah Praktek : {{ $ali->kp_ali }}</p>
                                <p class="text-black-100">Pekerjaan : {{ $ali->pkj_ali }}</p>
                            </div>
                        </div>
                    </div>
                </button>
            @endforeach
        </section>
        <section class="w-full flex justify-center">
            <iframe class="w-4/5" src="{{$dummy->link_dummy}}" frameborder="0">
            </iframe>
        </section>
    </main>
</x-clinet>
