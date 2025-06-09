@extends('layouts.admin.app')

@section('title', 'Read Artikel')

@section('content')
<!--Tabel User-->
<div class="col-lg-12col-lg-12 form-wrapper" id="kelola-user">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Kelola Tabel Artikel</h4>
      </div>
        <div class="container">
          @csrf
                @method('PUT')
                <div class="card-body" style="overflow-x:overlay;">
                    <div class="form-group">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Judul Artikel</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" id="nama" value="{{ $artikel->judul_atk }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Gambar Artikel</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="gambar_atk" id="gambar_atk" value="{{ $artikel->gambar_atk }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Kategori Artikel</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" placeholder="" name="password" id="password" value="{{ $artikel->kategori_atk }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Kategori Artikel</label>
                            <div class="col-sm-9">
                                @foreach ($artikel->tagatk as $tag)
                                {{ $tag->nama_tag }},
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Konten Artikel</label>
                            <div class="col-sm-9">
                                <textarea name="konten" value="{{ $artikel->konten_atk }}" style="height:300px;" class="form-control custom-txt-area" placeholder="Masukkan konten artikel..." id="konten" disabled>{{ $artikel->konten_atk }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
</div>
    <!--./Tabel User-->
@endsection
