@extends('layouts.admin.app')

@section('title', 'Ubah Data Alumni')

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
                            <h3 class="card-title">Ubah Data Alumni</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @isset($Error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ $Error }}
                            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endisset
                        @if(auth()->user()->id_role == 888)
                            <form method="POST" action="{{ route('admin.alumni.update',  $alis ->id) }}"  enctype='multipart/form-data'>
                        @elseif(auth()->user()->id_role == 1000)
                            <form method="POST" action="{{ route('penris.alumni.update',  $alis ->id) }}"  enctype='multipart/form-data'>
                        @endif
                            @csrf
                            @method('PUT')
                            <div class="card-body" style="overflow-x:overlay;">
                                <div class="form-group">
                                    <label for="">Nama Alumni</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="" value="{{ $alis->nama_ali }}">
                                    @error('nama')
                                    <div id="nama-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan Alumni</label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" placeholder="" value="{{ $alis->jabatan_ali }}">
                                    @error('jabatan')
                                    <div id="jabatan-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kp">Kerja Praktik Alumni</label>
                                    <input type="text" name="kp" id="kp" class="form-control @error('kp') is-invalid @enderror" placeholder="" value="{{ $alis->kp_ali }}">
                                    @error('kp')
                                    <div id="kp-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pkj">Pekerjaan Alumni</label>
                                    <input type="text" name="pkj" id="pkj" class="form-control @error('pkj') is-invalid @enderror" placeholder="" value="{{ $alis->pkj_ali }}">
                                    @error('pkj')
                                    <div id="pkj-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="thn">Tahun Lulus Alumni</label>
                                    <input type="number" name="thn" id="thn" class="form-control @error('thn') is-invalid @enderror" placeholder="" value="{{ $alis->thn_ali }}">
                                    @error('thn')
                                    <div id="thn-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="prodi">Prodi Alumni</label>
                                    <input type="text" name="prodi" id="prodi" class="form-control @error('prodi') is-invalid @enderror" placeholder="" value="{{ $alis->prodi_ali }}">
                                    @error('prodi')
                                    <div id="prodi-error" class="invalid-feedback ">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto Alumni</label>
                                    @if(isset($alis) && $alis->foto_ali)
                                       <div class="mb-3">
                                          <img src="{{ asset('storage/' . $alis->foto_ali) }}" alt="Foto Alumni" class="img-thumbnail" style="max-height: 150px;">
                                       </div>
                                    @endif
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
                        </div>
                        </form>
                    </div>
                    <!-- /.card -->
                @endsection
