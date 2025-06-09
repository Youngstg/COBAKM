@extends('layouts.admin.app')

@section('title', 'Lihat Penristek')

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
              <h3 class="card-title">Lihat <b>{{ $penristek->judul }}</b></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
                @csrf
                @method('PUT')
                <div class="card-body" style="overflow-x:overlay;">
                    <div class="form-group">
                        <table class="m-0 table table-hover mb-0 dataTable-table table-borderless">
                            <tr>
                                <th style="width: 20%">Judul</th>
                                <td style="width: 2%">:</td>
                                <td style="width: 78%"  class="text-justify">{{ $penristek->judul }}</td>
                            </tr>
                            <tr>
                                <th>Gambar</th>
                                <td>:</td>
                                <td class="text-justify">
                                    <div class="d-flex row">
                                        <div>
                                            <img src="{{ asset('storage/'.$penristek->gambar) }}" alt="" class="object-contain" width="200px" height="120px">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>:</td>
                                <td class="text-justify">{!! $penristek->deskripsi !!}</td>
                            </tr>
                            <tr>
                                <th>Link Penristek</th>
                                <td>:</td>
                                <td class="text-justify">{{ $penristek->link_penristek }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
          </div>
          <!-- /.card -->
@endsection
