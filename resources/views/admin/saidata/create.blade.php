@extends('layouts.admin.app')

@section('title', 'Tambah Data')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(auth()->user()->id_role == 888)
                            <form method="POST" action="{{ route('admin.saidata.store') }}"  enctype='multipart/form-data'>
                        @elseif(auth()->user()->id_role == 1000)
                            <form method="POST" action="{{ route('penris.saidata.store') }}"  enctype='multipart/form-data'>
                        @endif
                            @csrf
                            <div class="card-body" style="overflow-x:overlay;">
                                <div class="form-group">
                                    <label for="judul">Judul SaiData</label>
                                    <input name="judul" value="{{ old('judul') }}"
                                        class="form-control @error('judul') is-invalid @enderror" id="judul"
                                        id="judul" placeholder="Masukkan Judul...">
                                    @error('judul')
                                        <div id="judul-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo SaiData</label>
                                    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="logo" required>
                                    @error('logo')
                                          <div id="logo-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                 </div>
                                <div class="form-group">
                                    <label for="sub_judul">Sub Judul SaiData</label>
                                    <input name="sub_judul" class="form-control @error('sub_judul') is-invalid @enderror"
                                        id="sub_judul" placeholder="Masukkan Sub Judul SaiData..." required
                                        value="{{ old('sub_judul') }}">
                                    @error('sub_judul')
                                        <div id="sub_judul-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="desk_sub">Deskripsi Sub Judul SaiData</label>
                                    <input name="desk_sub" class="form-control @error('desk_sub') is-invalid @enderror"
                                        id="desk_sub" placeholder="Masukkan Deskripsi Sub Judul SaiData..." required
                                        value="{{ old('desk_sub') }}">
                                    @error('desk_sub')
                                        <div id="desk_sub-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
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
