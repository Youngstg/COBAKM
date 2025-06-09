@extends('layouts.admin.app')

@section('title', 'Kelola Data Penristek')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Semua Data Penristek</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x:overlay">
                            @if ($penristeks->count() > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penristeks as $key => $penristek)
                                            <tr>
                                                <td>{{ $penristeks->firstItem() + $key }}</td>
                                                <td>{{ $penristek->judul }}</td>
                                                <td class="text-justify">{!! $penristek->deskripsi !!}</td>
                                                <td>
                                                    @if(auth()->user()->id_role == 888)
                                                    <a href="{{ route('admin.penristek.show', $penristek->slug)}}" class="btn btn-info mr-1"><i class="fa-solid fa-eye"></i></a>
                                                    <a href="{{ route('admin.penristek.edit', $penristek->slug)}}" class="btn btn-primary"><i class="fa-solid fa-marker"></i></a>
                                                    @elseif(auth()->user()->id_role == 1000)
                                                    <a href="{{ route('penris.penristek.show', $penristek->slug)}}" class="btn btn-info mr-1"><i class="fa-solid fa-eye"></i></a>
                                                    <a href="{{ route('penris.penristek.edit', $penristek->slug)}}" class="btn btn-primary"><i class="fa-solid fa-marker"></i></a>
                                                    @endif
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#hapus-{{ $penristek->id }}">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div id="hapus-{{ $penristek->id }}" class="modal fade" tabindex="-1"
                                                        role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog bd-danger">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        <strong>Hapus Data Penristek</strong>
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data penristek ini?
                                                                    <br> <strong>"{{ $penristek->judul }}"</strong>
                                                                </div>
                                                                <div class="modal-footer">
                                                                @if(auth()->user()->id_role == 888)
                                                                    <form method="POST" action="{{route('admin.penristek.destroy', $penristek->id)}}"  enctype='multipart/form-data'>
                                                                @elseif(auth()->user()->id_role == 1000)
                                                                    <form method="POST" action="{{route('penris.penristek.destroy', $penristek->id)}}"  enctype='multipart/form-data'>
                                                                @endif
                                                                @method('DELETE')
                                                                @csrf
                                                                        <input type="submit" class="btn btn-danger light"
                                                                            name="" id="" value="Hapus">
                                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                Saat ini belum ada data penristek yang tersedia.
                            @endif
                        </div>
                        <!-- /.card-body -->
                        @if ($penristeks->count() > 0)
                            <div class="card-footer clearfix">
                                {{ $penristeks->links('pagination::simple-bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
