@extends('layouts.admin.app')

@section('title', 'Ubah SaiData')

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
                            <h3 class="card-title">Ubah SaiData</h3>
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
                            <form method="POST" action="{{ route('admin.saidata.update', $sais->id) }}"  enctype='multipart/form-data'>
                        @elseif(auth()->user()->id_role == 1000)
                            <form method="POST" action="{{ route('penris.saidata.update', $sais->id) }}"  enctype='multipart/form-data'>
                        @endif
                            @csrf
                            @method('PUT')
                            <div class="card-body" style="overflow-x:overlay;">
                                <div class="form-group">
                                    <label for="judul">Judul SaiData</label>
                                    <input class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" placeholder="" value="{{ $sais->judul_sai }}">
                                    @error('judul')
                                        <div id="judul-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo SaiData</label>
                                    <<input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="logo">
                                    @error('logo')
                                        <div id="logo-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <img src="{{ asset('storage/' . $sais->logo_sai) }}" alt=""
                                        class="object-contain" width="200px" height="120px">
                                </div>
                                <div class="form-group">
                                    <label for="sub_judul">Sub Judul SaiData</label>
                                    <input type="text" name="sub_judul" id="sub_judul" class="form-control @error('sub_judul') is-invalid @enderror" placeholder="" value="{{ $sais->sub_judul_sai }}">
                                    @error('sub_judul')
                                        <div id="sub_judul-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="desk_sub">Deskripsi Sub Judul SaiData</label>
                                    <input type="text" name="desk_sub" id="desk_sub" class="form-control @error('desk_sub') is-invalid @enderror" placeholder="" value="{{ $sais->desk_sub_judul_sai }}">
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
