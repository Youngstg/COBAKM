@extends('layouts.client.app')

@section('title', 'Semua Arsip Publik | Website KM ITERA')


@section('preloader')
<?php $datas = json_decode($data); ?>
@foreach ($datas as $preload)
    <link rel="preload" as="image" href="{{ asset('storage/' . $preload->logo_sai) }}">
@endforeach
@endsection

<x-client>
    <main>
        <section
            class="h-96 md:h-[60vh] bg-half-eclips bg-no-repeat bg-bottom md:bg-eclips-beranda md:bg-right lg:bg-right-top aspect-square relative w-full mx-auto">
            <div class="title flex flex-col items-center justify-center h-96 md:h-[60vh]">
                <h1 class="text-neutral-white text-4xl leading-relaxed font-bold text-center">
                    Arsip KM ITERA
                </h1>
                <p class="text-neutral-white text-xl leading-relaxed md:px-60 text-center">
                    Arsip publik KM ITERA berfungsi sebagai media penyimpanan dokumen-dokumen digital yang dapat diakses
                    dan
                    menjadi sumber informasi bagi kabinet selanjutnya.
                </p>
            </div>
        </section>
        <div>
            <!-- search -->
            <div class="flex justify-end gap-2 py-8 mx-2 md:mx-4">
                <input class="block rounded-md px-2 py-3 w-full md:w-1/4" placeholder="Cari Arsip Publik.." type="text"
                    id="mySearch" onkeyup="search()">

                <button class="search w-16 md:w-14">
                    <img src="{{ asset('assets/images/filter-alur.svg') }}" alt="">
                </button>
            </div>
        </div>
        <section class="container justify-start mx-4 md:mx-6">
            <div
                class="flex justify-start items-center gap-4 md:gap-20 md:text-2xl font-bold text-neutral-white text-center overflow-x-auto">
                @foreach ($judul as $nav)
                    <ul>
                        <li>
                            <a class="nav-menu hover:text-yellow-100 filter-button cursor-pointer"
                                data-judul="{{ $nav->judul_sai }}">{{ $nav->judul_sai }}</a>
                        </li>
                    </ul>
                @endforeach
            </div>
        </section>
        <section class="container justify-start mx-2 md:mx-4 mt-3">
            <article class="grid grid-cols-1 md:grid-cols-3" id="data-container">
                {{-- Content here --}}
            </article>
        </section>
    </main>
</x-client>
@section('script')
<script>
    data = {!! $data !!};

    const filterData = (judul) => {
        var filteredData = data.filter(function (item) {
            return item.judul_sai === judul;
        });

        var html = '';
        filteredData.forEach(function (item) {
            html += '<a href="arsip/' + item.unique_id + '">';
            html +=
                '<button class="card text-neutral-white border-4 border-yellow-100 mx-6 my-3 rounded-xl text-left md:mx-4 md:mt-5 hover:-translate-y-3 hover:bg-black-75"><div class="flex"><div class="w-2/6 p-4 border-r-4 border-yellow-100 items-center flex">';
            html += '<img src="{{asset("storage/")}}/' + item.logo_sai +
                '" alt="Gambar"class="w-full object-contain"></div><div class="flex flex-col w-4/6 p-2 md:p-5 justify-center">';
            html += '<h2 class="text-xl md:text-2xl font-bold mb-1">' + item.sub_judul_sai +
                '</h2><div class="flex gap-2">';
            html +=
                '<img src="{{ asset('assets/images/icon_script.svg') }}" class="w-fit object-contain"><h2 class="text-base md:text-2xl">' +
                item.total_arsip + ' Arsip Publik</h2></div></div></div></button></a>';
        });

        document.getElementById('data-container').innerHTML = html;
    }

    var filterButtons = document.getElementsByClassName('filter-button');
    for (var i = 0; i < filterButtons.length; i++) {
        filterButtons[i].addEventListener('click', function () {
            var judul = this.getAttribute('data-judul');
            filterData(judul);
        });
    }

    filterData(filterButtons[0].getAttribute('data-judul'));

    const search = () => {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("mySearch");
        filter = input.value.toUpperCase();
        ul = document.getElementById("data-container");
        li = ul.getElementsByTagName("a");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("h2")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
                li[i].style.visibility = "visible";
            } else {
                li[i].style.display = "none";
                li[i].style.visibility = "hidden";
            }
        }
    }
</script>
@endsection
