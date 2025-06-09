@extends('layouts.admin.app')

@section('title', 'Lihat Produk')

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
              <h3 class="card-title">Lihat <b>{{ $produks }}</b></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
                @csrf
                @method('PUT')
                <div class="card-body" style="overflow-x:overlay;">
                    <div class="form-group">
                        <h1>On development</h1>
                    </div>
                </div>
                <!-- /.card-body -->
          </div>
          <!-- /.card -->
@endsection
