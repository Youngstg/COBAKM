@extends('layouts.admin.app')

@section('title', 'Lihat Dummy')

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
              <h3 class="card-title">Lihat Dummy <b>{{ $dummy->nama_dummy }}</b></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
                @csrf
                @method('PUT')
                <div class="card-body" style="overflow-x: overlay">
                    <div class="form-group">
                        <table class="m-0 table table-hover mb-0 dataTable-table table-borderless">
                            <tr>
                                <th style="width: 20%">Nama Dummy</th>
                                <td style="width: 2%">:</td>
                                <td style="width: 78%">{{ $dummy->nama_dummy }}</td>
                            </tr>
                            <tr>
                                <th>Link Dummy</th>
                                <td>:</td>
                                <td>
                                    <div class="d-flex row">
                                        <div class="mr-2">
                                            <p>{{$dummy->link_dummy}}</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Foto Dummy</th>
                                <td>:</td>
                                <td>
                                    <div class="d-flex row">
                                        <div>
                                            <img src="{{ asset('storage/'. $dummy->foto_dummy) }}" width="300px" height="300px" frameborder="0" cellspacing="0"/>
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
        </div>
      </div>
    </div>
</section>
@endsection
