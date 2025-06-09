@extends('layouts.admin.app')

@section('title', 'Buat Tag')

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
              <h3 class="card-title">Buat Tag Baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('admin.tag-artikel.store') }}" enctype='multipart/form-data'>
                @csrf
                <div class="card-body" style="overflow-x:overlay;">
                <div class="form-group">
                  <label for="nama">Nama Tag</label>
                  <input name="nama" required value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama Tag...">
                  @error('nama')
                    <div id="nama-error" class="error invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-text">
                    Catatan: Slug tag akan ditentukan otomatis oleh sistem dan tidak dapat diubah sendiri oleh pengguna, kecuali dengan mengubah nama tagnya.
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
@endsection
