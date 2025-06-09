@extends('layouts.admin.app')

@section('title', 'Ubah Arsip')

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
                            <h3 class="card-title">Ubah Arsip</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(auth()->user()->id_role == 888)
                            <form method="POST" action="{{ route('admin.arsip.update',  $arps ->id) }}"  enctype='multipart/form-data'>
                        @elseif(auth()->user()->id_role == 1000)
                            <form method="POST" action="{{ route('penris.arsip.update',  $arps ->id) }}"  enctype='multipart/form-data'>
                        @endif
                            @csrf
                            @method('PUT')
                            <div class="card-body" style="overflow-x:overlay;">
                                <div class="form-group">
                                    <label for="judul_arp">Judul Arsip</label>
                                    <input class="form-control @error('judul_arp') is-invalid @enderror" name="judul_arp" id="judul_arp" placeholder="" value="{{ $arps->judul_arp }}">
                                    @error('judul_arp')
                                        <div id="judul_arp-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="link_arp">Link Arsip</label>
                                    <input class="form-control @error('link_arp') is-invalid @enderror" name="link_arp" id="link_arp" placeholder="" value="{{ $arps->link_arp }}">
                                    @error('link_arp')
                                        <div id="link_arp-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_arp">Tanggal Arsip</label>
                                    <input class="form-control @error('tgl_arp') is-invalid @enderror" name="tgl_arp" id="tgl_arp" placeholder="" value="{{ $arps->tgl_arp }}">
                                    @error('tgl_arp')
                                        <div id="tgl_arp-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="publisher_arp">Publisher Arsip</label>
                                    <input type="text" name="publisher_arp" id="publisher_arp" class="form-control @error('publisher_arp') is-invalid @enderror" placeholder="" value="{{ $arps->publisher_arp }}">
                                    @error('publisher_arp')
                                        <div id="publisher_arp-error" class="error invalid-feedback">{{ $message }}</div>
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
