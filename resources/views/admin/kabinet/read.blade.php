@extends('layouts.admin.app')

@section('title', 'Lihat Kabinet')

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
              <h3 class="card-title">Lihat Kabinet <b>{{ $kbts->nama_kbt }}</b></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
                @csrf
                @method('PUT')
                <div class="card-body" style="overflow-x:overlay;">
                    <div class="form-group">
                        <table class="m-0 table table-hover mb-0 dataTable-table table-borderless">
                            <tr>
                                <th style="width: 20%">Nama Kabinet</th>
                                <td style="width: 2%">:</td>
                                <td style="width: 78%" class="text-justify">{{ $kbts->nama_kbt }}</td>
                            </tr>
                            <tr>
                                <th>Logo Kabinet</th>
                                <td>:</td>
                                <td>
                                    <div class="d-flex row">
                                        <div>
                                            <img src="{{ asset('storage/'.$kbts->logo_kbt) }}" alt="logo kbt" width="300px">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Foto Kabinet</th>
                                <td>:</td>
                                <td>
                                    <div class="d-flex row">
                                        <div>
                                            <img src="{{ asset('storage/'.$kbts->foto_kbt) }}" alt="foto kbt" width="300px">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
          </div>
          <!-- /.card -->
@endsection
