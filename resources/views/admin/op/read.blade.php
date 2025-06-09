@extends('layouts.admin.app')

@section('title', 'Lihat Detail Operasional')

@section('content')
<!--Tabel User-->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-12 form-wrapper">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Lihat Detail Operasional</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
                <div class="card-body" style="overflow-x:overlay;">
                <div class="form-group">
                  <label for="nama">Nama Aset</label>
                  <input name="nama" required value="{{ old('nama', $op->nama_op) }}" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama Aset...">
                  @error('nama')
                    <div id="nama-error" class="error invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    @if ($op->kategori_op == 1)
                        <input class="form-control custom-txt-area @error('kategori') is-invalid @enderror" name="kategori" type="text" value="Barang" disabled>
                    @else
                        <input class="form-control custom-txt-area @error('kategori') is-invalid @enderror" name="kategori" type="text" value="Ruangan" disabled>
                    @endif
                    @error('kategori')
                        <div id="kategori-error" class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan Aset</label>
                    <textarea name="catatan" value="{{ old('catatan', $op->catatan_op) }}" class="form-control custom-txt-area @error('catatan') is-invalid @enderror" placeholder="Masukkan catatan aset..." id="catatan" disabled>{{ old('catatan', $op->catatan_op) }}</textarea>
                    @error('catatan')
                        <div id="catatan-error" class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar Aset</label>
                   <img src="{{ asset('storage/' . old('gambar', $op->gambar_op)) }}" alt="Current Image" style="max-width: 100px;">
                    @error('gambar')
                        <div id="gambar-error" class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
</section>
    <!--./Tabel User-->
@endsection
