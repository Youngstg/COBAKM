@extends('layouts.admin.app')

@section('title', 'Ubah Aset Operasional')

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
              <h3 class="card-title">Ubah Aset Operasional</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if(auth()->user()->id_role == 888)
            <form method="POST" action="{{ route('admin.operasional.update',$op->id) }}" enctype='multipart/form-data'>
            @elseif(auth()->user()->id_role == 999)
            <form method="POST" action="{{ route('op.operasional.update',$op->id) }}" enctype='multipart/form-data'>
            @endif
                @method('PUT')
                @csrf
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
                    <select name="kategori" required class="custom-select form-control-border @error('kategori') is-invalid @enderror" id="kategori">
                        <option>=== PILIH KATEGORI ===</option>
                        <option value="1" {{ old('kategori', $op->kategori_op) == 1 ? 'selected' : '' }}>Barang</option>
                        <option value="2" {{ old('kategori', $op->kategori_op) == 2 ? 'selected' : '' }}>Ruangan</option>
                    </select>
                    @error('kategori')
                        <div id="kategori-error" class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan Aset (opsional)</label>
                    <textarea name="catatan" value="{{ old('catatan', $op->catatan_op) }}" class="form-control custom-txt-area @error('catatan') is-invalid @enderror" placeholder="Masukkan catatan aset..." id="catatan">{{ old('catatan', $op->catatan_op) }}</textarea>
                    @error('catatan')
                        <div id="catatan-error" class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar Aset (opsional)</label>
                     <img src="{{ asset('storage/' . old('gambar', $op->gambar_op)) }}" alt="Current Image" style="max-width: 100px;">
                    <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror">
                    @error('gambar')
                        <div id="gambar-error" class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                    {{-- <div id="gambarHelpBlock" class="form-text">
                        Link gambar yang diterima hanya link dari Google Drive dan yang akan disimpan hanya ID-nya saja. Pastikan Akses umum/General access gambar pada menu "Bagikan/Share" telah diubah menjadi
                        "Siapa saja yang memiliki link/Anyone with the link" dan Peranan/Role tetap pada "Pelihat/Viewer."
                    </div> --}}
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
          <!-- /.card -->
@endsection
