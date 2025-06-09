@section('title', 'Website KM ITERA | Alur Sistem')

<x-client>
    <section class="h-96 md:h-[50vh] bg-primary-beranda bg-no-repeat bg-bottom bg-cover relative m-4 rounded-2xl">

        <h1
            class="text-gasendra-blue-primary text-3xl md:text-5xl uppercase leading-relaxed px-5 font-bold absolute inset-0 flex items-center justify-center text-center">
            Alur Sistem
        </h1>

    </section>
    <section class="container mx-auto py-10">
        <article class=" md:-mt-10">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <a class="bg-blue-75 py-12 text-neutral-white mt-10 mx-8 rounded-lg text-center md:mx-3 md:mt-5 md:grid-rows-1 md:text-3xl hover:-translate-y-3 hover:bg-black cursor-pointer"
                    id="btnUKT" onclick="openModal('.modalUKT')" data-aos="fade-up" data-aos-duration="1500">Banding
                    UKT</a>
                <a class="bg-gasendra-yellow-primary py-12 text-neutral-white mt-5 mx-8 rounded-lg text-center md:mx-3 md:grid-rows-1 md:text-3xl hover:-translate-y-3 hover:bg-black cursor-pointer"
                    id="btnpikr" onclick="openModal('.modalpikr')" data-aos="fade-up" data-aos-duration="1700">PIK -
                    R</a>
                <a class="bg-black-75 py-12 text-neutral-white mt-5 mx-8 rounded-lg text-center md:mx-3 md:grid-rows-1 md:text-3xl hover:-translate-y-3 hover:bg-black cursor-pointer"
                    id="btnsukma" onclick="openModal('.modalsukma')" data-aos="fade-up" data-aos-duration="1900">Sukma
                    KM
                    ITERA</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2">
                <a href="https://op-km-itera.com/"
                    class="bg-blue-75 md:text-3xl py-12 text-neutral-white mt-5 mx-8 rounded-lg text-center md:mx-3 md:col-span-1 hover:-translate-y-3 hover:bg-black cursor-pointer"
                    data-aos="fade-up" data-aos-duration="2100">Peminjaman
                    Ruangan</a>
                <a href="/ecommerce"
                    class="bg-yellow-100 md:text-3xl py-12 text-neutral-white mt-5 mx-8 rounded-lg text-center md:mx-3 md:col-span-1 hover:-translate-y-3 hover:bg-black cursor-pointer"
                    data-aos="fade-up" data-aos-duration="2300">Lapak
                    KM</a>
            </div>
        </article>

    </section>

    <!-- MODAL YGY -->
    <section class="modalUKT hidden fixed top-20 left-1/2 -translate-x-1/2 z-40">
        <article
            class="bg-neutral-100 rounded-lg overflow-hidden shadow-lg shadow-[rgb(137, 148, 67)] transform transition-all  border-2 border-yellow-100 w-max md:px-56">
            <div class="flex px-6 pt-4 pb-4 rounded-t-lg justify-center items-center">
                <h2 class="text-gasendra-blue-primary text-lg font-semibold text-center md:text-3xl">Banding UKT</h2>
            </div>
            <div class="flex justify-center items-center">
                @if ($banding != null && $banding['foto_dummy'])
                    <img src="{{ asset('storage/' . $banding['foto_dummy']) }}" alt="Banding KM-ITERA"
                        class="object-contain" width="200px" height="200px">
                @else
                    <img src="{{ asset('assets/images/No_img_vertical.jpg') }}" width="200px" height="200px" alt="">
                @endif
            </div>
            <div class="px-5 py-5 flex justify-evenly text-white">
                <button
                    class="modalUKT-close bg-black-50 font-bold py-2 px-8 mx-2 rounded-lg hover:bg-black-75 hover:shadow-md hover:shadow-[rgb(137, 148, 67)] focus:outline-none focus:shadow-outline-blue active:bg-zinc-300"
                    onclick="closeModal('.modalUKT')">Close</button>
                <a href={{ $banding != null ? $banding['link_dummy'] : '' }}
                    class="submit bg-yellow-100  font-bold py-2 px-8 mx-2 rounded-lg hover:bg-black-75 hover:shadow-md hover:shadow-[rgb(137, 148, 67)] focus:outline-none focus:shadow-outline-blue active:bg-zinc-300">
                    Link
                </a>
            </div>
        </article>
    </section>
    <section class="modalpikr hidden fixed top-20 left-1/2 -translate-x-1/2 z-40">
        <article
            class="bg-neutral-100 rounded-lg overflow-hidden shadow-lg shadow-[rgb(137, 148, 67)] transform transition-all border-2 border-yellow-100 w-max md:px-56">
            <div class="flex px-6 pt-4 pb-4 rounded-t-lg justify-center items-center">
                <h2 class="text-gasendra-blue-primary text text-lg font-semibold text-center md:text-3xl">PIK-R</h2>
            </div>
            <div class=" flex justify-center items-center">
                @if ($pikr != null && $pikr['foto_dummy'])
                    <img src="{{ asset('storage/' . $pikr['foto_dummy']) }}" alt="PIK-R KM-ITERA" class="object-contain"
                        width="200px" height="200px">
                @else
                    <img src="{{ asset('assets/images/No_img_vertical.jpg') }}" width="200px" height="200px" alt="">
                @endif
            </div>
            <div class="px-5 py-5  flex justify-evenly text-white">
                <button
                    class="modalpikr-close bg-black-50 font-bold py-2 px-8 mx-2 rounded-lg hover:bg-black-75 hover:shadow-md hover:shadow-[rgb(137, 148, 67)] focus:outline-none focus:shadow-outline-blue active:bg-zinc-300"
                    onclick="closeModal('.modalpikr')">Close</button>
                <a href="{{ $pikr != null ? $pikr['link_dummy'] : '' }}"
                    class="submit bg-yellow-100 font-bold py-2 px-8 mx-2 rounded-lg hover:bg-black-75 hover:shadow-md hover:shadow-[rgb(137, 148, 67)] focus:outline-none focus:shadow-outline-blue active:bg-zinc-300">
                    Link
                </a>
            </div>
        </article>
    </section>
    <div class="overlay hidden z-20 bg-black/70 absolute top-0 left-0 h-[150vh] w-screen" onclick="closeAllModal()">
    </div>
    <section class="modalsukma hidden fixed top-20 left-1/2 -translate-x-1/2 z-40">
        <article
            class="bg-neutral-100 rounded-lg overflow-hidden shadow-lg shadow-[rgb(137, 148, 67)] transform transition-all border-2 border-yellow-100 w-max md:px-56">
            <div class="flex px-6 pt-4 pb-4 rounded-t-lg justify-center items-center">
                <h2 class="text-gasendra-blue-primary text text-lg font-semibold text-center md:text-3xl">Sukma KM-ITERA
                </h2>
            </div>
            <div class=" flex justify-center items-center">
                @if ($sukma != null && $sukma['foto_dummy'])
                    <img src="{{ asset('storage/' . $sukma['foto_dummy']) }}" alt="Sukma KM-ITERA" class="object-contain"
                        width="200px" height="200px">
                @else
                    <img src="{{ asset('assets/images/No_img_vertical.jpg') }}" width="200px" height="200px" alt="cek">
                @endif
            </div>
            <div class="px-5 py-5 flex justify-evenly text-white">
                <button
                    class="modalsukma-close text-white bg-black-50 font-bold py-2 px-8 mx-2 rounded-lg hover:bg-black-75 hover:shadow-md hover:shadow-[rgb(137, 148, 67)] focus:outline-none focus:shadow-outline-blue active:bg-zinc-300"
                    onclick="closeModal('.modalsukma')">Close</button>
                <a href="{{ $sukma != null ? $sukma['link_dummy'] : '' }}"
                    class="submit bg-yellow-100 font-bold py-2 px-8 mx-2 rounded-lg hover:bg-black-75 hover:shadow-md hover:shadow-[rgb(137, 148, 67)] focus:outline-none focus:shadow-outline-blue active:bg-zinc-300">
                    Link
                </a>
            </div>
        </article>
    </section>
</x-client>

<script>
    function openModal(e) {
        let target = document.querySelector(e);
        let overlay = document.querySelector('.overlay');
        target.classList.remove("hidden");
        overlay.classList.remove("hidden");
    }

    function closeModal(e) {
        let target = document.querySelector(e);
        let overlay = document.querySelector('.overlay');
        overlay.classList.add("hidden");
        target.classList.add("hidden");
    }

    function closeAllModal() {
        document.querySelector(".modalUKT").classList.add('hidden');
        document.querySelector(".modalpikr").classList.add('hidden');
        document.querySelector(".modalsukma").classList.add('hidden');
        let overlay = document.querySelector('.overlay');
        overlay.classList.add("hidden");
    }
</script>