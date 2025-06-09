@section('title', $activity->title_kmac . ' | Website KM ITERA')

<x-client>
    <main class="container mx-auto py-5 lg:px-0 md:px-8 px-3">
        <!-- Jumbotron -->
        <figure class="rounded-xl h-96 w-full relative bg-cover bg-center bg-no-repeat md:h-[60vh] lg:h-[80vh]"
            style="background-image: url('{{ $activity->gambar_kmac ? asset("storage/$activity->gambar_kmac") : asset('assets/images/No_img_horizontal.png') }}');">
            <div class="bg-slate-900 absolute bottom-7 p-3 rounded-br-xl rounded-tr-xl lg:px-5">
                <p class="font-bold text-sm md:text-base lg:text-lg text-white">
                    {{ $activity->title_kmac }}
                </p>
                <span class=" my-5 text-sm md:text-base lg:text-lg text-white">
                    {{ Carbon\Carbon::parse($activity->tgl_pelaksanaan)->translatedFormat('l, d F Y H:i') }}
                </span>
            </div>
        </figure>
        <article class="lg:px-5">
            <section class="my-10">
                <p class="text-black my-2">Ketua Pelaksana : {{ $activity->ketuplak_kmac }}</p>

            </section>

            <section>
                <span class="text-black">
                    {!! $activity->konten_kmac !!}
                </span>
            </section>
            @if ($activity->tags->count() > 0)
                <section class="my-10">
                    <p class=" my-2 content-around">
                        <span class="font-bold">Tag:</span>
                        @foreach ($activity->tags as $key => $tag)
                            @if ($key + 1 != $activity->tags->count())
                                <span
                                    class="hover:bg-gasendra-yellow-primary hover:text-white rounded-md p-1 ease-in-out font-semibold">
                                    {{ $tag->nama_tag }}</span>
                            @else
                                <span
                                    class="hover:bg-gasendra-yellow-primary hover:text-white  rounded-md p-1 ease-in-out font-semibold">
                                    {{ $tag->nama_tag }}</span>
                            @endif
                        @endforeach
                    </p>
                </section>
            @endif
        </article>
    </main>
</x-client>