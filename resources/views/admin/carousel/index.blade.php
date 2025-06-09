@extends('layouts.admin.app')
@section('title', 'Kelola Carousel')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kelola Carousel</h3>
                            <a href="{{ Auth::user()->id_role == 1111 ? route('ekraf.carousel.create') : route('admin.carousel.create') }}"
                                class="btn btn-primary float-right">Tambah
                                Carousel</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">No</th>
                                        <th style="width: 40%">Detail</th>
                                        <th style="width: 20%">Aksi</th>
                                        <th style="width: 20%">Pindah Urutan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carousels as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($item->image_path)
                                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="Item Image"
                                                        style="max-width: 100px;">
                                                @else
                                                    <p>No image available</p>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ Auth::user()->id_role == 1111 ? route('ekraf.carousel.edit', $item->id) : route('admin.carousel.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa-solid fa-marker"></i>
                                                </a>
                                                <form
                                                    action="{{ Auth::user()->id_role == 1111 ? route('ekraf.carousel.destroy', $item->id) : route('admin.carousel.destroy', $item->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                @if (Auth::user()->id_role == 1111)
                                                    <form action="{{ route('admin.carousel.changeOrder', $item->id) }}"
                                                        method="POST" style="display:inline;">
                                                    @else
                                                        <form action="{{ route('ekraf.carousel.changeOrder', $item->id) }}"
                                                            method="POST" style="display:inline;">
                                                @endif
                                                @csrf
                                                <button type="submit" name="direction" value="up"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-arrow-up"></i>
                                                </button>
                                                <button type="submit" name="direction" value="down"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-arrow-down"></i>
                                                </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
