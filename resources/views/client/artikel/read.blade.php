@section('title', $artikel->judul_atk . ' | Website KM ITERA')

<x-client>
    <main class="container mx-auto pt-5 lg:px-0 md:px-8 px-3">
        <!-- Jumbotron -->
        <figure class="rounded-xl h-96 w-full relative bg-cover bg-center bg-no-repeat md:h-[60vh] lg:h-[80vh]"
            style="background-image: url('{{ $artikel->gambar_atk ? asset("/storage/$artikel->gambar_atk") : asset('assets/images/No_img_horizontal.png') }}');">
            <div class="bg-slate-900 absolute bottom-7 p-3 rounded-br-xl rounded-tr-xl lg:px-5">
                <p class="font-bold text-sm md:text-base lg:text-lg text-white">
                    {{ $artikel->judul_atk }}
                </p>
                <span class=" my-5 text-sm md:text-base lg:text-lg text-white">
                    {{ Carbon\Carbon::parse($artikel->published_at)->translatedFormat('l, d F Y H:i') }}
                </span>
            </div>
        </figure>
        <article class="lg:px-5">
            <section class="my-10">
                <p class="text-black my-2">Penulis : {{ $artikel->penulis_atk }}</p>
                @if ($artikel->kategori_atk)
                    <p class="text-black my-2">Kategori : {{$artikel->kategori_atk}}</p>
                @endif
            </section>

            <section>
                <span class="text-black">
                    {!! $artikel->konten_atk !!}
                </span>
            </section>
            @if ($artikel->tagatk->count() > 0)
                <section class="my-10">
                    <p class="text-black my-2 content-around">
                        <span class="font-bold">Tag:</span>
                        @foreach ($artikel->tagatk as $key => $tag)
                            @if ($key + 1 != $artikel->tagatk->count())
                                <a class="hover:bg-gasendra-yellow-primary hover:text-white rounded-md p-1 ease-in-out font-semibold"
                                    href="/tag/{{ $tag->slug_tag }}">{{ $tag->nama_tag }}</a>
                            @else
                                <a class="hover:bg-gasendra-yellow-primary hover:text-white  rounded-md p-1 ease-in-out font-semibold"
                                    href="/tag/{{ $tag->slug_tag }}">{{ $tag->nama_tag }}</a>
                            @endif
                        @endforeach
                    </p>
                </section>
            @endif
        </article>
    </main>
</x-client>