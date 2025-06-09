@extends('layouts.admin.app')

@section('title', 'Kelola Data Produk')
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
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Semua Data Produk</h3>
            </div>
            <div class="px-2 pt-4">
                <form action="{{ route('admin.produk.index') }}" method="GET">
                    <div class="flex mb-4">
                        <input type="text" name="search" placeholder="Cari erdasarkan Nama Produk"
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
                            <th class="border border-cms-text-gray py-2 px-4 w-[10%]">
                                No
                            </th>
                            <th class="border border-cms-text-gray py-2 px-4 w-[60%]">
                                Detail
                            </th>
                            <th class="border border-cms-text-gray py-2 px-4 w-[30%]">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $produk)
                            <tr class="">
                                <td class="border border-cms-text-gray py-2 px-4 text-center">
                                    {{ $produk->id }}
                                </td>
                                <td class="border border-cms-text-gray py-2 px-4 text-center">
                                    <h1 class="text-xl font-bold">{{ $produk->nama_produk }}</h1>
                                    <a href="#" class="text-blue-500 underline">{{ $produk->deskripsi }}</a>
                                </td>
                                <td class="border border-cms-text-gray p-auto h-full text-center">
                                    @if (Auth::user()->id_role = 1111)
                                    <a href="{{ route('ekraf.produk.edit', $produk->id) }}" @else <a
                                            href="{{ route('admin.produk.edit', $produk->id) }}" @endif
                                            class="bg-cms-blue rounded-md px-3 py-2"><i class="bi bi-pencil"></i></a>
                                        <button type="button" class="btn btn-danger ml-1" data-toggle="modal"
                                            data-target="#hapus-{{ $produk->id }}"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                        <!-- Modal -->
                                        <div id="hapus-{{ $produk->id }}" class="modal fade" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog bd-danger">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Hapus
                                                                User</strong></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus beasiswa ini? <br>
                                                        "{{ $produk->nama_produk }}"
                                                    </div>
                                                    <div class="modal-footer">
                                                        @if (Auth::user()->id_role = 1111)
                                                            <form action="{{ route('ekraf.produk.destroy', $produk->id) }}"
                                                                method="POST">
                                                            @else
                                                                <form
                                                                    action="{{ route('admin.produk.destroy', $produk->id) }}"
                                                                    method="POST">
                                                        @endif
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="submit" class="btn btn-danger light" name=""
                                                            id="" value="Hapus">
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">Tidak</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $produks->links() }}
                </div>
            </div>
        </div>

    </section>
@endsection
