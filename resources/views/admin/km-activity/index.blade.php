@extends('layouts.admin.app')

@section('title', 'Kelola Aktivitas KM')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Semua Aktivitas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow-x:overlay;">
                        @if ($kmacs->count() > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Title</th>
                                        <th>Ketua Pelaksana</th>
                                        <th>Tanggal Dimulai</th>
                                        <th>Deskripsi singkat</th>
                                        <th>Tag</th>
                                        <th>Gambar</th>
                                        <th>Features</th>
                                        <th>Aksi</th>
                                        {{-- <th style="width: 40px">Label</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kmacs as $kmac)
                                        <tr>
                                            <td>{{ $kmac->id }}</td>
                                            <td><strong>{{ $kmac->title_kmac }}</strong><br>
                                                <a href="/activity/{{ $kmac->slug_kmac }}"
                                                    target="_blank">https://km.itera.ac.id/activity/{{ Str::limit($kmac->slug_kmac, 20) }}</a>
                                                <br>
                                            </td>
                                            <td>{{$kmac->ketuplak_kmac}}</td>
                                            <td>
                                                {{ $kmac->formatted_date }}
                                            </td>
                                            <td>
                                                {{ $kmac->deskripsi_kmac }}
                                            </td>
                                            <td>
                                                @foreach($kmac->tags as $tag)
                                                    <span class="badge bg-info">{{ $tag->nama_tag }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($kmac->gambar_kmac)
                                                    <img src="{{asset("/storage/$kmac->gambar_kmac")}}"
                                                        alt="gambar{{$kmac->title_kmac}}" style="width:150px; heigth:150px">
                                                @else
                                                    <p>Tidak ada gambar</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($kmac->features_kmac == 0)
                                                    Tidak aktif
                                                @else
                                                    Aktif
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <a href="{{ route('admin.km-activity.edit', $kmac->slug_kmac) }}"
                                                    class="btn btn-primary">
                                                    <i class="fa-solid fa-marker"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapus-{{ $kmac->id }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div id="hapus-{{ $kmac->id }}" class="modal fade" tabindex="-1" role="dialog"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog bd-danger">
                                                        <div class="modal-content bg-danger">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    <strong>Hapus kmac</strong>
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus kmac ini? <br>
                                                                <strong>"{{ $kmac->judul_kmac }}"</strong>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form
                                                                    action="{{ route('admin.km-activity.destroy', $kmac->slug_kmac) }}"
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
                            Saat ini belum ada tag kmac yang tersedia.
                        @endif
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection