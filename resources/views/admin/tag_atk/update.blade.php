@extends('layouts.admin.app')

@section('title', 'Ubah Tag')

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
              <h3 class="card-title">Ubah Tag "{{ $tag->nama_tag }}"</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('admin.tag-artikel.update',$tag->id) }}" enctype='multipart/form-data'>
                @method('PUT')
                @csrf
                <div class="card-body" style="overflow-x:overlay;">
                <div class="form-group">
                  <label for="nama">Nama Tag</label>
                  <input name="nama" value="{{ old('nama', $tag->nama_tag) }}" required class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama Tag...">
                  @error('nama')
                  <div id="nama-error" class="error invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">https://km.itera.ac.id/tag/</span>
                        </div>
                        <input name="slug" disabled value="{{ old('slug', $tag->slug_tag) }}" class="form-control" id="slug" placeholder="Masukkan Slug Tag...">
                    </div>
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
