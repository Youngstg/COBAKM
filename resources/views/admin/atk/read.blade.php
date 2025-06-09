@extends('layouts.admin.app')

@section('title', 'Lihat Artikel')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-12 form-wrapper">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Lihat Artikel "{{ $artikel->judul_atk }}"</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="overflow-x:overlay;">
                            <h3>{{ $artikel->judul_atk }}</h3>
                            <div>
                                <strong>Penulis Artikel: </strong> {{ $artikel->penulis_atk }} |
                                <strong>Dibuat Pada:</strong> {{ $artikel->created_at->translatedFormat('l, d F Y H:i:s') }}
                                |
                                <strong>Terbit Pada:</strong>
                                {{ \Carbon\Carbon::parse($artikel->published_at)->translatedFormat('l, d F Y H:i:s') }}
                            </div>
                            <div>
                                <strong>Status:</strong>
                                @if ($artikel->published_at == $artikel->created_at or date('Y-m-d H:i:s') >= $artikel->published_at)
                                    Telah Terbit
                                @else
                                    Belum Terbit
                                @endif
                            </div>
                            @if ($artikel->gambar_atk != null)
                                <div class="embed-responsive embed-responsive-16by9">
                                    <img src="{{ asset('storage/'.$artikel->gambar_atk) }}" alt="{{ $artikel->nama_atk }}" class="object-contain" width="200px" height="120px">
                                </div>
                            @endif
                            <br>
                            <div>
                                {!! $artikel->konten_atk !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <p><strong>Tag Artikel:</strong>
                                @if ($artikel->tagatk->count() > 0)
                                    @foreach ($artikel->tagatk as $tag)
                                        <span class="badge bg-info">{{ $tag->nama_tag }}</span>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                    <!-- /.card -->
    </section>
@endsection
