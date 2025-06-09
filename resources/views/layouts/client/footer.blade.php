<footer class="bg-footer-main lg:py-10 lg:px-20 px-8 py-8 text-[#189AC5] w-full  shadow-shadow-footer mt-5">
    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-flow-row xl:gap-40 md:gap-5 gap-10 max-w-[115rem] mx-auto">
        <div>
            <div class="flex items-center w-full">
                @foreach ($logos as $logo)
                    @if ($logo != null)
                        <img src="{{ asset($logo->logo_kbt) }}" alt="Logo {{$logo->nama_kbt}}"
                            class="h-20 px-2 md:h-24 lg:h-24 lg:px-5 " />
                        <div class="">
                            <h3 class="md:text-2xl md:pr-8 text-base font-bold uppercase">KABINET {{$logo->nama_kbt}}</h3>
                            <p class="md:text-base text-sm font-light ">KELUARGA MAHASISWA ITERA</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @foreach ($footers as $footer)
                <div class="px-2 md:px-3 lg:px-5 md:pt-5 w-full row-start-3 lg:row-auto">
                    <ul class="flex flex-row lg:justify-center gap-6">
                        @if(is_array($footer->sosmed) || $footer->sosmed != null)
                            @foreach($footer->sosmed as $sosmed)
                                <a href="{{ $sosmed['link'] }}" target="_blank">
                                    <li class="flex text-2xl lg:text-4xl">
                                        <i class="fa-brands fa-{{$sosmed['icon']}}"></i>
                                    </li>
                                </a>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="px-2 md:px-3 lg:px-5 lg:pt-5 w-full md:row-span-3 lg:row-auto">
                    <div class="flex flex-col gap-3">
                        @if ($footer->no_cp[0] != null && $footer->email != null)
                            <h2 class="md:text-2xl text-base font-bold">Kontak Kami</h2>
                        @endif
                        @if ($footer->alamat_sekre != null)
                            <li class="flex md:text-base text-sm items-center gap-3 max-w-sm md:max-w-none">
                                <i class="fa-solid fa-location-dot" style="color: #189AC5;"></i>
                                <p>{{$footer->alamat_sekre}}</p>
                            </li>
                        @endif
                        @if($footer->no_cp[0] != null)
                            <li class="flex md:text-base text-sm items-center gap-3">
                                <i class="fa-solid fa-phone" style="color: #189AC5;"></i>
                                <div>
                                    @if(is_array($footer->no_cp))
                                        @foreach($footer->no_cp as $no)
                                            <p>{{$no}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </li>
                        @endif
                        @if ($footer->email != null)
                            <li class="flex md:text-base text-sm items-center gap-3">
                                <i class="fa-solid fa-envelope" style="color: #189AC5;"></i>
                                <p>{{$footer->email}}</p>
                            </li>
                        @endif
                    </div>
                </div>
            </div>
            <div class="px-2 md:px-5 lg:px-7 lg:mt-12 mt-10">
                <p class="text-sm text-center md:text-base lg:text-lg md:py-1 lg:py-2">
                    @if ($footer->hak_cipta != null)
                        &copy;{{$footer->hak_cipta}}.
                    @endif
                </p>
            </div>
        @endforeach
</footer>