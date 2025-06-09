@section('title', 'Peminjaman Barang - Operasional | Website KM-ITERA')
<x-client>
    <section class="py-20 mx-auto opacity-80">
        <h1 class="w-1/2 mx-auto text-center text-neutral-white font-bold text-3xl ">Peminjaman Barang</h1>
        <div class="sm:w-full w-3/4 justify-center flex sm:flex-row flex-col mx-auto pt-4 gap-2">
            <a class="bg-beranda text-xl py-3 px-5 text-slate-300 font-semibold rounded-xl hover:drop-shadow hover:shadow-lg"
                href="{{$pinjam->link_dummy}}" target="blank">
                Link Peminjaman Barang
            </a>
            <a class="bg-transparent border-2 border-beranda drop-shadow shadow-md hover:bg-white/5 text-xl py-3 px-5 text-slate-300 font-semibold rounded-xl"
                href="{{$pengembalian->link_dummy}}" target="blank">
                Link pengembalian Barang
            </a>
        </div>
    </section>

    <section class="pt-10">
        <div class="flex justify-end gap-4 mx-8 md:mx-2">
            <input class="block rounded-md px-2 py-3 w-full md:w-1/4" placeholder="Cari Barang.." type="text"
                id="mySearch" onkeyup="search">

            <button class="search w-16 md:w-14">
                <img src="{{ asset('assets/images/filter-alur.svg') }}" alt="">
            </button>
        </div>

        <article class="grid grid-cols-1 md:grid-cols-4" id="listbarang" onkeyup="search()">
            @foreach ($ops as $op)
                <button
                    class="barang bg-yellow-100 text-neutral-white font-bold mt-5 mx-8 rounded-lg text-left md:mx-3 md:mt-5 hover:-translate-y-3 hover:bg-black-75">
                    <div class="flex md:block">
                        <div class="w-1/2 p-0 md:w-auto h-auto md:h-3/4">
                            @if ($op->gambar_op !== null)
                                <img src="{{ asset('storage/' . $op->gambar_op) }}" alt="Gambar {{ $op->nama_op }}"
                                    class="w-full h-full object-cover rounded-lg">
                            @else
                                <img src="{{ asset('assets/images/No_img_vertical.jpg') }}" alt="Gambar {{ $op->nama_op }}"
                                    class="w-full h-full object-cover rounded-lg">
                            @endif
                        </div>
                        <div class="w-1/2 p-5 md:w-auto">
                            <h2 class="text-lg font-bold mb-12 ">{{ $op->nama_op }}</h2>
                            @if ($op->catatan_op !== NULL)
                                <p class="text-neutral-white">
                                    Catatan: <br>
                                    {{ $op->catatan_op }}
                                </p>
                            @endif
                        </div>
                    </div>
                </button>
            @endforeach
        </article>
    </section>

    <script>
        function search() {
            var input, filter, listbarang, barang, i, txtValue;
            input = document.getElementById("mySearch");
            filter = input.value.toUpperCase();
            listbarang = document.getElementById("listbarang");
            barang = listbarang.getElementsByClassName("barang");

            for (i = 0; i < barang.length; i++) {
                var txtValue = barang[i].querySelector("h2").textContent || barang[i].querySelector("h2").innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    barang[i].classList.remove("visually-hidden");
                } else {
                    barang[i].classList.add("visually-hidden");
                }
            }
        }
    </script>
</x-client>
