@extends('layouts.admin.app')

@section('title', 'Kelola Aktivitas')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Semua Artikel</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow-x:overlay;">
                        @if ($articles->count() > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Detail</th>
                                        <th>Tag</th>
                                        <th>Features</th>
                                        <th>Aksi</th>
                                        {{-- <th style="width: 40px">Label</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articles as $key => $artikel)
                                        <tr>
                                            <td>{{ $articles->firstItem() + $key }}</td>
                                            <td><strong>{{ $artikel->judul_atk }}</strong><br>
                                                <a href="/artikel/{{ $artikel->slug_atk }}"
                                                    target="_blank">https://km.itera.ac.id/artikel/{{ Str::limit($artikel->slug_atk, 20) }}</a>
                                                <br>
                                                <div class="btn-group mt-2">
                                                    <button type="button" class="btn btn-default btn-flat btn-sm">Penulis:
                                                        {{ $artikel->penulis_atk }}</button>
                                                    <button type="button" class="btn btn-default btn-flat btn-sm">
                                                        Status:
                                                        @if ($artikel->published_at == $artikel->created_at or date('Y-m-d H:i:s') >= $artikel->published_at)
                                                            Telah Terbit
                                                        @else
                                                            Belum Terbit
                                                        @endif
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-flat btn-sm">Dibuat pada:
                                                        {{ $artikel->created_at->translatedFormat('l, d F Y H:i:s') }}</button>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($artikel->tagatk->count() > 0)
                                                    @foreach ($artikel->tagatk as $tag)
                                                        <span class="badge bg-info">{{ $tag->nama_tag }}</span>
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{$artikel->features_atk == '1' ? 'Aktif' : 'Tidak Aktif'}}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <a href="{{ route('admin.artikel.edit', $artikel->slug_atk) }}"
                                                    class="btn btn-primary">
                                                    <i class="fa-solid fa-marker"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapus-{{ $artikel->id }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div id="hapus-{{ $artikel->id }}" class="modal fade" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog bd-danger">
                                                        <div class="modal-content bg-danger">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    <strong>Hapus Artikel</strong>
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus artikel ini? <br>
                                                                <strong>"{{ $artikel->judul_atk }}"</strong>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form
                                                                    action="{{ route('admin.artikel.destroy', $artikel->slug_atk) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <input type="submit" class="btn btn-danger light" name=""
                                                                        id="" value="Hapus">
                                                                    <button type="button" class="btn btn-pr   ry"
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
                            Saat ini belum ada tag artikel yang tersedia.
                        @endif
                    </div>
                    <!-- /.card-body -->
                    @if ($articles->count() > 0)
                        <div class="card-footer clearfix">
                            {{ $articles->links('pagination::simple-bootstrap-5') }}
                        </div>
                    @endif
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection
