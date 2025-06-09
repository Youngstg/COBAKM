@extends('layouts.admin.app')

@section('title', 'Kelola SaiData')

@section('content')
    <!--./Tabel User-->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Semua Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x:overlay">
                            @if ($sais->count() >= 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Judul</th>
                                            <th>Logo</th>
                                            <th>Sub Judul SaiData</th>
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sais as $sai => $value)
                                            <tr>
                                                <td class="text-center">{{ $sais->firstItem() + $sai }}</td>
                                                <td>{{ $value->judul_sai }}</td>
                                                <td><img src="{{ asset('storage/'.$value->logo_sai) }}" alt=""></td>
                                                <td>{{ $value->sub_judul_sai }}</td>
                                                <td>
                                                    @if(auth()->user()->id_role == 888)
                                                    <a href="{{ route('admin.arsip.create', ['id' => $value->id]) }}" class="btn btn-success">Tambah Arsip</a>
                                                    <a href="{{ route('admin.saidata.show', $value->id)}}" class="btn btn-info mr-1"><i class="fa-solid fa-eye"></i></a>
                                                    <a href="{{ route('admin.saidata.edit', $value->id)}}" class="btn btn-primary"><i class="fa-solid fa-marker"></i></a>
                                                    @elseif(auth()->user()->id_role == 1000)
                                                    <a href="{{ route('penris.arsip.create', ['id' => $value->id]) }}" class="btn btn-success">Tambah Arsip</a>
                                                    <a href="{{ route('penris.saidata.show', $value->id)}}" class="btn btn-info mr-1"><i class="fa-solid fa-eye"></i></a>
                                                    <a href="{{ route('penris.saidata.edit', $value->id)}}" class="btn btn-primary"><i class="fa-solid fa-marker"></i></a>
                                                    @endif
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#hapus-{{ $value->id }}"><i
                                                            class="fa-solid fa-trash-can"></i></button>
                                                    <!-- Modal -->
                                                    <div id="hapus-{{ $value->id }}" class="modal fade" tabindex="-1"
                                                        role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog bd-danger">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        <strong>Hapus SaiData</strong>
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data ini? <br>
                                                                    "{{ $value->judul_sai }}"
                                                                </div>
                                                                <div class="modal-footer">
                                                                    @if(auth()->user()->id_role == 888)
                                                                        <form method="POST" action="{{route('admin.saidata.destroy', $value->id)}}"  enctype='multipart/form-data'>
                                                                    @elseif(auth()->user()->id_role == 1000)
                                                                        <form method="POST" action="{{route('penris.saidata.destroy', $value->id)}}"  enctype='multipart/form-data'>
                                                                    @endif
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <input type="submit" class="btn btn-danger light"
                                                                            name="" id="" value="Hapus">
                                                                        <button type="button" class="btn btn-primary"
                                                                            data-dismiss="modal">Tidak</button>
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
                                Saat ini, belum ada Saidata yang tersedia.
                            @endif
                        </div>
                        <!-- /.card-body -->
                        @if ($sais->count() > 0)
                            <div class="card-footer clearfix">
                                {{ $sais->links('pagination::simple-bootstrap-5') }}
                            </div>
                        @endif
                    </div>

                </div>
                <!-- /.card -->
            </div>
        </div>
        </div>
    </section>
@endsection
