@extends('layouts.admin.app')

@section('title', 'Read User')

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
              <h3 class="card-title">User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
                @csrf
                @method('PUT')
                <div class="card-body" style="overflow-x:overlay;">
                    <div class="form-group">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nama User</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" id="nama" value="{{ $users->nama }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="fitra@gabut.com" name="email" id="email" value="{{ $users->email }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" placeholder="" name="password" id="password" value="{{ $users->password }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Id Role</label>
                            <div class="col-sm-9">
                              <input type="" class="form-control" placeholder="" name="password" id="password" value="{{ $users->id_role }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
          </div>
          <!-- /.card -->
@endsection
