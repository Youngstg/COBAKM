<header class="sticky top-0 bg-gasendra-blue-primary py-4 px-6 z-40 shadow-md">
    <nav class="lg:flex lg:items-center lg:justify-between max-w-[115rem] mx-auto">
        <div class="flex justify-between items-center">
            <a href="/">
                <div class="flex items-center p-3 transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <img src="{{ asset('assets/images/km_logo_400x500.png') }}" alt="LogoKM"
                        class="h-12 w-12 object-contain rounded-full shadow-md transition duration-300 transform hover:rotate-6" />
                    <h1 class="text-lg md:text-2xl font-semibold text-gray-100 ml-4">
                        KM-ITERA
                    </h1>
                </div>
            </a>
            <div class="border rounded-lg border-black-border p-2 lg:hidden flex">
                <div class="text-2xl cursor-pointer lg:hidden text-neutral-white flex flex-col content-center">
                    <i class="fa-solid fa-bars" style="color: #ffffff;" onclick="Open('.menu-mobile')"></i>
                </div>
            </div>
        </div>
        <div class="menu-mobile hidden transition-all duration-300 lg:flex mt-5 lg:mt-0">
            <ul
                class="lg:flex lg:items-center bg-white h-screen lg:bg-transparent lg:h-auto text-black-100 z-[-1] lg:z-auto lg:static absolute w-full left-0 lg:w-auto pt-2 md:pt-10 lg:pt-0 transition-all ease-in duration-100">
                <li class="mx-2 mb-2 md:mt-0 lg:my-0">
                    <a href="{{ Request::routeIs('beranda') ? '#' : '/' }}"
                        class="text-xl  duration-100 px-4 block py-1 text-black lg:text-white font-medium hover:scale-105 hover:rounded-3xl  {{ Request::routeIs('beranda') ? 'font-semibold hover:scale-100' : '' }}">
                        Beranda
                    </a>
                </li>
                <li class="group mx-2 my-2 lg:my-0 md:relative hidden">
                    <a href="/saidata">
                        <button
                            class="text-xl duration-100 px-1  w-full text-start py-2 border-none bg-transparent text-black lg:text-white font-medium hover:text-white {{ Request::routeIs('saidata*') || Request::routeIs('bsws*') || Request::routeIs('alumni*') || Request::routeIs('arsip*') || Request::routeIs('operasional*') ? 'text-white' : 'text-white' }}">
                            Sai Data Itera
                        </button>
                    </a>
                    @if (Request::routeIs('saidata*') ||
                            Request::routeIs('operasional*') ||
                            Request::routeIs('arsip*') ||
                            Request::routeIs('bsws*') ||
                            Request::routeIs('alumni*'))
                        <div
                            class="invisible group-hover:visible text-black-25 bg-black-100 max-md:w-full py-3 px-5 md:px-0 md:rounded duration-100 translate-y-4 absolute z-10">
                            <ul class="md:py-3 md:w-52">
                                <li class="group/href">
                                    <a href="/saidata/beasiswa"
                                        class="block md:py-3 md:px-5 group-hover/href:text-white group-hover/href:bg-gasendra-blue-primary">
                                        <span class="text-lg font-normal">
                                            Beasiswa
                                        </span>
                                        <p class="font-extralight text-base">
                                            List program beasiswa
                                        </p>
                                    </a>
                                </li>
                                <li class="group/href">
                                    <a href="/saidata/alumni"
                                        class="block md:p-3 group-hover/href:text-white group-hover/href:bg-black-75 rounded-md">
                                        <span class="text-lg font-normal">
                                            KP dan Alumni
                                        </span>
                                        <p class="font-extralight text-base">
                                            List alumni
                                        </p>
                                    </a>
                                </li>
                                <li class="group/href">
                                    <a href="/saidata/arsip"
                                        class="block md:p-3 group-hover/href:text-white group-hover/href:bg-black-75 rounded-md">
                                        <span class="text-lg font-normal">
                                            Arsip Publik
                                        </span>
                                        <p class="font-extralight text-base">
                                            Arsip organisasi
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </li>

                <li class="group mx-2 my-2 lg:my-0 md:relative">
                    <a>
                        <button
                            class="text-xl text-black lg:text-white font-medium duration-150 px-4 w-full text-start py-1 border-none hover:scale-105  hover:rounded-3xl {{ Request::routeIs('tentang') || Request::routeIs('kabinet') || Request::routeIs('client.ormawa.index') ? 'font-semibold hover:scale-100' : '' }}">
                            Tentang
                        </button>
                    </a>
                    <div
                        class="transition-all duration-300  max-h-0 -mt-3 group-hover:mt-1 group-hover:max-h-96 text-black-100 overflow-hidden bg-white lg:shadow-sm max-md:w-full px-5 md:px-0 md:rounded lg:translate-y-9 translate-y-3 mb-6 lg:absolute z-10">
                        <ul class="md:w-56 flex flex-col gap-3 lg:gap-0">
                            <li class="group/href">
                                <a href="/tentang-km"
                                    class="block md:py-3 md:px-5 group-hover/href:text-white group-hover/href:bg-gasendra-blue-primary">
                                    <span class="text-lg font-normal">
                                        KM-ITERA
                                    </span>
                                    <p class="font-extralight text-base md:block hidden">
                                        Keluarga Mahasiswa ITERA
                                    </p>
                                </a>
                            </li>
                            <li class="group/href">
                                <a href="/{{ $kbt != null ? 'kabinet/' . $kbt->slug_kbt : '/' }}"
                                    class="block md:py-3 md:px-5 group-hover/href:text-white group-hover/href:bg-gasendra-blue-primary">
                                    <span class="text-lg font-normal">
                                        Kabinet
                                    </span>
                                    <p class="font-extralight text-base md:block hidden">
                                        Kabinet KM-ITERA
                                    </p>
                                </a>
                            </li>
                            <li class="group/href">
                                <a href="/ormawa"
                                    class="block md:py-3 md:px-5 group-hover/href:text-white group-hover/href:bg-gasendra-blue-primary">
                                    <span class="text-lg font-normal">
                                        Ormawa
                                    </span>
                                    <p class="font-extralight text-base md:block hidden">
                                        Organisasi Mahasiswa di ITERA
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="group mx-2 my-2 lg:my-0 md:relative">
                    <a>
                        <button
                            class="text-xl text-black lg:text-white font-medium duration-100 px-4 w-full text-start py-1 border-none hover:scale-105  hover:rounded-3xl {{ Request::routeIs('alur*') || Request::routeIs('ecommerce*') ? 'font-semibold hover:scale-100' : '' }}">
                            Alur Sistem
                        </button>
                    </a>
                    <div
                        class="transition-all duration-300 max-h-0 -mt-3 group-hover:mt-1 group-hover:max-h-[30rem] text-black-100 overflow-hidden bg-white lg:shadow-sm max-md:w-full px-5 md:px-0 md:rounded lg:translate-y-9 translate-y-3 mb-6 lg:absolute z-10">
                        <ul class="md:w-56 flex flex-col gap-3 lg:gap-0">
                            <li class="group/href">
                                <a href="/alur"
                                    class="block md:py-3 md:px-5 group-hover/href:text-white group-hover/href:bg-gasendra-blue-primary">
                                    <span class="text-lg font-normal">
                                        Alur
                                    </span>
                                    <p class="font-extralight text-base md:block hidden">
                                        Alur sistem KM-ITERA
                                    </p>
                                </a>
                            </li>
                            <li class="group/href">
                                <a href="https://op-km-itera.com/"
                                    class="block md:py-3 md:px-5 group-hover/href:text-white group-hover/href:bg-gasendra-blue-primary">
                                    <span class="text-lg font-normal">
                                        Peminjaman
                                    </span>
                                    <p class="font-extralight text-base md:block hidden">
                                        List dan izin peminjaman
                                    </p>
                                </a>
                            </li>
                            <li class="group/href">
                                <a href="/ecommerce"
                                    class="block md:py-3 md:px-5 group-hover/href:text-white group-hover/href:bg-gasendra-blue-primary">
                                    <span class="text-lg font-normal">
                                        Lapak KM-ITERA
                                    </span>
                                    <p class="font-extralight text-base md:block hidden">
                                        Menjual produk untuk Mahasiswa
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mx-2 my-2 lg:my-0">
                    <a href="/kritiksaran">
                        <button
                            class="text-xl lg:text-white font-medium text-black duration-100 px-4 w-full text-start py-1 border-none hover:scale-105  hover:rounded-3xl {{ Request::routeIs('kritiksaran') ? 'font-semibold hover:scale-100' : '' }}">
                            Kritik dan Saran
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
