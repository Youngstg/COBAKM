@section('title', ($judul ?? 'Kabar dari KM-ITERA') . ' - Artikel | Website KM ITERA')

<x-client>
    <main class="w-full relative">
        <!-- jumbotron-->
        <section class="h-[55vh] bg-primary-beranda bg-no-repeat bg-cover bg-bottom m-4 relative rounded-xl">

            <h1
                class="text-gasendra-blue-primary text-3xl md:text-5xl leading-relaxed px-5 font-bold absolute inset-0 flex items-center justify-center text-center">
                {{ $judul ?? 'Kabar dari KM-ITERA' }}
            </h1>
            <h3 class="text-center text-white w-full items-center absolute">
                @foreach ($allTag as $tag)
                    <a class="bg-gasendra-yellow-primary rounded-b-md py-1 px-2 ease-in-out hover:bg-slate-600 m-auto"
                        href="/tag/{{ $tag->slug_tag }}">{{ $tag->nama_tag }}</a>
                @endforeach
            </h3>

        </section>
        <article
            class="grid grid-cols-1 gap-y-5 justify-center md:grid-cols-2 px-3 md:px-10 xl:grid-cols-3 gap-x-3 py-10"
            data-aos="fade-up" data-aos-duration="1500">
            @foreach ($articles as $key => $artikel)
                <a href="/artikel/{{ $artikel->slug_atk }}" class="relative w-full flex grow-1 shrink-0 md:basis-1/2">
                    @if ($artikel->gambar_atk !== null)
                        <img src="{{ asset('storage/' . $artikel->gambar_atk) }}" alt="{{ $artikel->judul_atk }}"
                            class="object-cover rounded-xl w-full" style="height: 250px;">
                    @else
                        <img src="{{ asset('assets/images/No_img_horizontal.png') }}"
                            class="object-cover rounded-xl w-full">
                    @endif
                    <div class="bg-white  absolute bottom-3 p-1 rounded-br-xl rounded-tr-xl">
                        <p class="font-bold text-gasendra-blue-primary text-sm md:text-base lg:text-lg">
                            {{ Str::limit($artikel->judul_atk, 25) }}
                        </p>
                    </div>
                </a>
            @endforeach
        </article>
    </main>
</x-client>
