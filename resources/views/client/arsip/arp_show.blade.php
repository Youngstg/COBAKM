@extends('layouts.client.app')

@section('title', $data->judul_sai . ' > ' . $data->sub_judul_sai . ' - Arsip Publik | Website KM ITERA')

<x-client>
    <section class="container relative w-full mx-auto">
        <div class="title grid md:grid-flow-col pt-5 px-7">
            <img src="{{ asset('storage/' . $data->logo_sai) }}" alt="Gambar"
                class="w-2/5 md:w-72 object-cover border-4 border-yellow-100 rounded-xl p-6 md:p-14">
            <div class="pb-5 items-center">
                <h1 class="text-neutral-white text-6xl font-bold text-left">
                    {{ $data->sub_judul_sai ?? '' }}
                </h1>
                <p class="text-neutral-white text-xl leading-relaxed text-justify">
                    {{ $data->desk_sub_judul_sai }}
                </p>
            </div>
        </div>

        <div>
            <p class="text-neutral-white px-5 text-xl">
                <span class="text-yellow-100">{{ $arp }}</span>
                Arsip Ditemukan
            </p>
            <article class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($arsip as $arsips)
                    <button
                        class="card text-neutral-white border-2 border-yellow-100 mx-6 my-3 rounded-xl text-left md:mx-4 md:mt-5 hover:-translate-y-3 hover:bg-black-75">
                        <div class="flex">
                            <div class="w-4/6 pl-3 p-2">
                                <h2 class="text-lg md:text-2xl font-bold mb-1">{{ $arsips->judul_arp }}</h2>
                                <div class="flex gap-2">
                                    <img src="{{ asset('assets/images/icon-profile.svg') }}" class="w-fit object-cover">
                                    <h2 class="text-base md:text-2xl">{{ $arsips->publisher_arp }}</h2>
                                </div>
                                <div class="flex gap-2">
                                    <img src="{{ asset('assets/images/icon-calendar.svg') }}" class="w-fit object-cover">
                                    <datetime class="text-base md:text-2xl">{{ $arsips->tgl_arp }}</datetime>
                                </div>
                            </div>
                            <div class="w-2/6 flex items-center">
                                <div class="flex rounded-lg px-0 items-center justify-center gap-2 bg-transparent">
                                    <img src="{{ asset('assets/images/icon-open.svg') }}" class="w-fit object-contain">
                                    <a target="_blank" href="{{ $arsips->link_arp }}" rel="noreferrer noopener">
                                        <h2 class="text-base md:text-2xl">Lihat Arsip</h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </button>
                @endforeach
            </article>
        </div>
    </section>
</x-client>
