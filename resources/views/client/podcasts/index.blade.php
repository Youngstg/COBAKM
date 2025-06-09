@section('title', 'Podcasts | KM-ITERA Official Website')
<x-client>
    <!-- Static Thumbnail -->
    <div class="mb-8">
        <div class="bg-cover bg-center justify-center items-center relative overflow-hidden md:h-[52rem] lg:h-[52.75rem] lg:pt-12 md:pt-8 pt-5 pb-6 md:pb-12 lg:pb-24 px-[1rem] md:px-[2rem] lg:px-[3.75rem] "
            data-aos="fade-up" data-aos-duration="1500"
            style="background-image: url('{{ asset('assets/images/new/bgJumbotron.png') }}')">
            <img src="{{ asset('storage/' . $topPage->thumbnail) }}" alt="Static Featured Podcast"
                class="w-full h-full md:h-[43.75rem] object-cover rounded-lg">
            <div class="absolute inset-x-0 md:inset-0 bottom-28 md:bottom-10 flex md:items-center justify-center">
                <div class="text-white text-center">
                    <a href="{{ $topPage->link }}" target="_blank"
                        class="bg-gasendra-yellow-primary font-semibold text-xs md:text-base text-white text-center px-2 py-1 md:px-6 md:py-3 rounded-full hover:bg-gasendra-yellow-secondary transition duration-300">
                        <i class="fab fa-youtube text-gasendra-blue text-xs"></i>
                        Tonton
                    </a>
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-4 lg:bottom-16 md:bottom-14 flex justify-center" data-aos="fade-up"
                data-aos-duration="1500">
                <a href="{{ $topPage->link }}" target="_blank"
                    class="inline-flex flex-col items-center bg-white text-black text-sm font-semibold px-16 py-2 md:px-56 md:py-6 rounded-xl shadow-lg hover:bg-gray-300 transition duration-300">
                    <span class="font-semibold text-xs md:font-base mb-2">Listen on</span>
                    <img src="{{ asset('assets/images/logos_youtube.svg') }}" alt="YouTube" class="h-2 md:h-5">
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto md:py-8 px-6">
        <!-- Latest Video -->
        @if ($latestPodcast)
            <div class="mb-8 pb-6 md:pb-12 border-b border-gray-400">
                <h2 class="text-3xl md:text-5xl md:text-left text-center font-bold text-gasendra-blue mb-8"
                    data-aos="fade-up" data-aos-duration="1500">Cek video
                    terbaru kami!!</h2>
                <div class="relative rounded-lg overflow-hidden" data-aos="fade-up" data-aos-duration="1500">
                    <a href="{{ $latestPodcast->link }}" target="_blank" class="block">
                        <img src="{{ asset('storage/' . $latestPodcast->thumbnail) }}" alt="{{ $latestPodcast->judul }}"
                            class="w-full h-fit lg:max-h-[700px] rounded-lg object-cover">
                    </a>
                    <a href="{{ $latestPodcast->link }}" target="_blank"
                        class="absolute top-2 right-2 text-red-600 text-4xl md:text-5xl hover:text-red-700 transition duration-300">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        @endif

        <!-- Podcast Listing -->
        <h2 class="text-3xl md:text-5xl text-center text-gasendra-blue font-bold mb-8 lg:mb-16" data-aos="fade-up"
            data-aos-duration="1500">Podcast <span class="text-gasendra-yellow-primary">KM-ITERA</span> lainnya</h2>
        <div class="grid grid-cols-1 gap-14">
            @foreach ($podcasts as $podcast)
                <div class="flex flex-col md:flex-row {{ $loop->index % 2 == 1 ? 'md:flex-row-reverse' : '' }}">
                    <div class="relative md:w-1/2 flex-shrink-0 max-h-[32rem]" data-aos="fade-up"
                        data-aos-duration="1500">
                        <a href="{{ $podcast->link }}" target="_blank">
                            <img src="{{ asset('storage/' . $podcast->thumbnail) }}" alt="{{ $podcast->judul }}"
                                class="w-full  rounded-lg object-cover">
                        </a>
                        <a href="{{ $podcast->link }}" target="_blank"
                            class="absolute top-2 right-2 text-red-600 text-3xl hover:text-red-700 transition duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <div class="lg:p-8 md:py-4 px-2 pt-8 md:px-6 text-left md:w-1/2" data-aos="fade-up"
                        data-aos-duration="1500">
                        <p class="text-xl font-semibold text-gasendra-blue">{{ $podcast->kategori }}</p>
                        <h3
                            class="text-3xl md:text-4xl lg:text-5xl text-gasendra-yellow-primary font-bold py-2 md:py-4">
                            {{ $podcast->judul }}
                        </h3>
                        <p class="text-sm md:text-lg text-black mb-4 break-words">{{ $podcast->deskripsi }}</p>
                        <div class="text-sm md:text-lg text-gray-500">
                            <p class="text-black font-semibold">Narasumber: {{ $podcast->narasumber }}</p>
                            <p class="text-black font-semibold">Pewawancara: {{ $podcast->pewawancara }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-client>
