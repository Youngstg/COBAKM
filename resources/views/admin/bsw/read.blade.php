@extends('layouts.admin.app')

@section('title', 'Lihat Beasiswa')

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
                            <h3 class="card-title">Lihat <b>{{ $bsws->judul_bsw }}</b></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @csrf
                        @method('PUT')
                        <div class="card-body" style="overflow-x:overlay;">
                            <div class="form-group">
                                <table class="m-0 table table-hover mb-0 dataTable-table table-borderless">
                                    <tr>
                                        <th style="width: 20%">Judul Beasiswa</th>
                                        <td style="width: 2%">:</td>
                                        <td style="width: 78%" class="text-justify">{{ $bsws->judul_bsw }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gambar Beasiswa</th>
                                        <td>:</td>
                                        <td class="text-justify">
                                            <div class="d-flex row">
                                                <div>
                                                    <img src="{{ asset('storage/'.$bsws->gambar_bsw) }}" alt="" class="object-contain" width="200px" height="120px">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Konten Beasiswa</th>
                                        <td>:</td>
                                        <td class="text-justify">{!! $bsws->konten_bsw !!}</td>
                                    </tr>
                                    @foreach ($link_bsws as $link_bsw)
                                        <tr>
                                            <th>Judul Link {{ $loop->iteration }}</th>
                                            <td>:</td>
                                            <td class="text-justify">{{ $link_bsw->judul_link }}</td>
                                        </tr>
                                        <tr>
                                            <th>Link {{ $loop->iteration }}</th>
                                            <td>:</td>
                                            <td class="text-justify">{{ $link_bsw->link }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                @endsection
