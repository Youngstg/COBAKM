@extends('layouts.admin.app')

@section('title', 'Tambah Arsip')

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
                            <h3 class="card-title">Tambah Data Arsip</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(auth()->user()->id_role == 888)
                            <form method="POST" action="{{ route('admin.arsip.store') }}"  enctype='multipart/form-data'>
                        @elseif(auth()->user()->id_role == 1000)
                            <form method="POST" action="{{ route('penris.arsip.store') }}"  enctype='multipart/form-data'>
                        @endif
                            @csrf
                            <div class="card-body" style="overflow-x:overlay;">
                                <div class="form-group">
                                    <label for="judul">Judul Arsip</label>
                                    <input name="judul_arp" class="form-control @error('judul_arp') is-invalid @enderror"
                                        id="judul_arp" placeholder="Masukkan Judul..." required
                                        value="{{ old('judul_arp') }}"> <input type="hidden" name="id_sai"
                                        value="{{ $id_sai }}" required>
                                    @error('judul_arp')
                                        <div id="judul_arp-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="link">Link Arsip</label>
                                    <input name="link_arp" class="form-control @error('link_arp') is-invalid @enderror"
                                        id="link_arp" placeholder="Masukkan Link Arsip..." required
                                        value="{{ old('link_arp') }}">
                                    @error('link_arp')
                                        <div id="link_arp-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_arp">Tanggal Arsip</label>
                                    <input name="tgl_arp" class="form-control @error('tgl_arp') is-invalid @enderror"
                                        id="tgl_arp" placeholder="Masukkan Tanggal Arsip (Tahun-Bulan-Tanggal)" required
                                        value="{{ old('tgl_arp') }}">
                                    @error('tgl_arp')
                                        <div id="tgl_arp-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="publisher_arp">Publisher Arsip</label>
                                    <input name="publisher_arp"
                                        class="form-control @error('publisher_arp') is-invalid @enderror" id="publisher_arp"
                                        placeholder="Masukkan Publisher..." required value="{{ old('publisher_arp') }}">
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
