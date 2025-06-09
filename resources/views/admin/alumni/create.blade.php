@extends('layouts.admin.app')

@section('title', 'Tambah Data Alumni')

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
                            <h3 class="card-title">Tambah Alumni</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(auth()->user()->id_role == 888)
                            <form method="POST" action="{{ route('admin.alumni.store') }}"  enctype='multipart/form-data'>
                        @elseif(auth()->user()->id_role == 1000)
                            <form method="POST" action="{{ route('penris.alumni.store') }}"  enctype='multipart/form-data'>
                        @endif
                            @csrf
                            <div class="card-body" style="overflow-x:overlay;">
                                <div class="form-group">
                                    <label for="nama">Nama Alumni</label>
                                    <input name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama..."required>
                                    @error('nama')
                                    <div id="nama-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan Kerja Alumni</label>
                                    <input name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" placeholder="Masukkan Jabatan Kerja Alumni..." required>
                                    @error('jabatan')
                                    <div id="jabatan-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kp">Kerja Praktik Alumni</label>
                                    <input name="kp" class="form-control @error('kp') is-invalid @enderror" id="kp" placeholder="Masukkan Tempat Kerja Praktik Alumni..." required>
                                    @error('kp')
                                    <div id="kp-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pkj">Pekerjaan Alumni</label>
                                    <input name="pkj" class="form-control @error('pkj') is-invalid @enderror" id="pkj" placeholder="Masukkan Pekerjaan Alumni..." required>
                                    @error('pkj')
                                    <div id="pkj-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="thn">Tahun Lulus Alumni</label>
                                    <input type="number" name="thn" class="form-control @error('thn') is-invalid @enderror" id="thn" placeholder="Masukkan Tahun Lulus Alumni..." required>
                                    @error('thn')
                                    <div id="thn-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="prodi">Prodi Alumni</label>
                                    <input name="prodi" class="form-control @error('prodi') is-invalid @enderror" id="prodi" placeholder="Masukkan Nama Program Studi Alumni..." required>
                                    @error('prodi')
                                    <div id="prodi-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto Alumni</label>
                                     <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto">
                                    @error('foto')
                                    <div id="foto-error" class="invalid-feedback ">{{ $message }}</div>
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
