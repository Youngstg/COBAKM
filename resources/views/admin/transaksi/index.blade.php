@extends('layouts.admin.app')

@section('title', 'Lihat Semua Transaksi')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'cms-gray': '#454D55',
                    'cms-red': '#e34b3c',
                    'cms-light-gray': '#d9d9d9',
                    'cms-dark-gray': '#343a40',
                    'cms-darker-gray': '#2F3439',
                    'cms-text-gray': '#6C757D',
                    'cms-blue': '#3f6791',
                },
            },
        },
    }
</script>
@endsection
@section('content')
<section class="content">
    <div class="card card-primary overflow-auto">
        <div class="card-header">
            <h3 class="card-title">Semua Transaksi</h3>
        </div>
        <div class="px-2 pt-4">
            <form action="{{ route('admin.transaksi.index') }}" method="GET">
                <div class="flex mb-4">
                    <input type="text" name="search" placeholder="Cari berdasarkan ID Transaksi"
                        class="border border-cms-text-gray py-2 px-4 w-full text-slate-700 rounded-sm"
                        value="{{ request('search') }}">
                    <button type="submit" class="ml-2 bg-cms-blue text-white px-4 py-2 rounded">
                        Cari
                    </button>
                </div>
            </form>
        </div>
        <div class="table p-2">
            <table class="border-2 border-cms-text-gray w-full table-auto border-collapse">
                <thead class="text-white text-center">
                    <tr>
                        <th class="border border-cms-text-gray py-2 px-4 w-[40%]">
                            ID Transaksi
                        </th>
                        <th class="border border-cms-text-gray py-2 px-4 w-[20%]">
                            Nama
                        </th>
                        <th class="border border-cms-text-gray py-2 px-4 w-[10%]">
                            No Hp
                        </th>
                        <th class="border border-cms-text-gray py-2 px-4 w-[20%]">
                            Email
                        </th>
                        <th class="border border-cms-text-gray py-2 px-4">Nama Produk</th>
                        <th class="border border-cms-text-gray py-2 px-4">Variant</th>
                        <th class="border border-cms-text-gray py-2 px-4">Ukuran</th>
                        <th class="border border-cms-text-gray py-2 px-4">Jumlah</th>
                        <th class="border border-cms-text-gray py-2 px-4">Harga</th>
                        <th class="border border-cms-text-gray py-2 px-4 w-[10%]">
                            Status
                        </th>
                        <th class="border border-cms-text-gray py-2 px-4 w-[10%]">
                            Tanggal Pemesanan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $transaksi)
                        <tr class="">
                            <td class="border border-cms-text-gray py-2 px-4 text-center">
                                {{ $transaksi->id }}
                            </td>
                            <td class="border border-cms-text-gray py-2 px-4 text-center">
                                {{ $transaksi->nama }}
                            </td>
                            <td class="border border-cms-text-gray py-2 px-4 text-center">
                                <a href="https://wa.me/{{$transaksi->no_wa}}" target="blank"
                                    class="text-primary">{{$transaksi->no_wa}}</a>
                            </td>
                            <td class="border border-cms-text-gray py-2 px-4 text-center">
                                {{ $transaksi->email }}
                            </td>
                            @foreach ($transaksi->daftar_produk as $daftar_produk)
                                <td class="border border-cms-text-gray py-2 px-4 text-center">
                                    {{$daftar_produk->produk->nama_produk}}
                                </td>
                                <td class="border border-cms-text-gray py-2 px-4 text-center">
                                    {{$daftar_produk->varian_produk->nama_varian}}
                                </td>
                                <td class="border border-cms-text-gray py-2 px-4 text-center">
                                    {{$daftar_produk->varian_produk->ukuran}}
                                </td>
                                <td class="border border-cms-text-gray py-2 px-4 text-center">
                                    {{$daftar_produk->jumlah}}
                                </td>
                                <td class="border border-cms-text-gray py-2 px-4 text-center">
                                    {{$transaksi->total_harga}}
                                </td>
                            @endforeach
                            <!-- $variants = $daftar_produk->variant_produk; -->
                            <td class="border border-cms-text-gray py-2 px-4 text-center">
                                @if ($transaksi->status_barang == 'diproses')
                                    Telah dibayar
                                @else
                                    {{ $transaksi->status_barang }}
                                @endif
                            </td>
                            <td>
                                {{ $transaksi->created_at->format('d-m-Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{$transaksis->links('pagination::simple-bootstrap-5')}}
            </div>
        </div>
    </div>
</section>
@endsection
