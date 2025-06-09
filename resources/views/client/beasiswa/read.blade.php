@section('title', $bsw->judul_bsw . ' | Website KM ITERA')

<x-client>
    <main class="container mx-auto pt-5">
        <!-- Jumbotron -->
        <figure
            class="bg-[url('{{ asset('storage/' . $bsw->gambar_bsw) }}')] rounded-xl h-96 w-full relative bg-cover bg-center bg-no-repeat md:h-[80vh]">
            <div class="bg-slate-600/75 absolute bottom-7 p-3 rounded-br-xl rounded-tr-xl">
                <p class="font-bold text-neutral-white text-sm md:text-base lg:text-lg">
                    {{ $bsw->judul_bsw }}
                </p>
                <span class="text-neutral-white my-5 text-sm md:text-base lg:text-lg">
                    {{ Carbon\Carbon::parse($bsw->created_at)->translatedFormat('l, d F Y H:i') }}
                </span>
            </div>
        </figure>
        <article>
            <section class="my-10">
                <span class="text-neutral-white text-justify">
                    {!! $bsw->konten_bsw !!}
                </span>
            </section>
            <section class="grid grid-cols-3 gap-2 w-fit max-[405px]:grid-cols-2">
                @foreach($links as $link)
                    <a href="{{ $link->link }}"
                        class="btn btn-primary bg-custom-blue text-xs p-3 text-white font-semibold rounded-lg">
                        {{ $link->judul_link }}
                    </a>
                @endforeach
            </section>
        </article>
    </main>
</x-client>
