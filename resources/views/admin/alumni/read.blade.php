@extends('layouts.admin.app')

@section('title', 'Read Alumni')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Alumni</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @csrf
                        @method('PUT')
                        <div class="card-body" style="overflow-x:overlay;">
                            <div class="form-group">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nama Alumni</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Nama Lengkap"
                                            name="nama_ali" id="nama_ali" id="nama" value="{{ $alis->nama_ali }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Jabatan Alumni</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="" name="jabatan_ali"
                                            id="jabatan_ali" value="{{ $alis->jabatan_ali }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Kerja Praktik Alumni</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="" name="kp_ali"
                                            id="kp_ali" value="{{ $alis->kp_ali }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Pekerjaan Alumni</label>
                                    <div class="col-sm-9">
                                        <input type="" class="form-control" placeholder="" name="pkj_ali"
                                            id="pkj_ali" value="{{ $alis->pkj_ali }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Tahun Lulus Alumni</label>
                                    <div class="col-sm-9">
                                        <input type="" class="form-control" placeholder="" name="thn_ali"
                                            id="thn_ali" value="{{ $alis->thn_ali }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prodi Alumni</label>
                                    <div class="col-sm-9">
                                        <input type="" class="form-control" placeholder="" name="prodi_ali"
                                            id="prodi_ali" value="{{ $alis->prodi_ali }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Foto Alumni</label>
                                    <div class="col-sm-9">
                                        <input type="" class="form-control" placeholder="" name="foto_ali"
                                            id="foto_ali" value="{{ $alis->foto_ali }}" disabled>
                                            <img src="{{ asset('storage/'.$alis->foto_ali) }}" alt="" class="object-contain" width="200px" height="120px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                @endsection
