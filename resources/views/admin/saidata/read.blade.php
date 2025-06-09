@extends('layouts.admin.app')

@section('title', 'Read SaiData')

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
                            <h3 class="card-title">SaiData</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @csrf
                        @method('PUT')
                        <div class="card-body" style="overflow-x:overlay;">
                            <div class="form-group">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Judul SaiData</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Judul SaiData"
                                            name="judul" id="judul"value="{{ $sais->judul_sai }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Sub Judul SaiData</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="sub_judul_sai"
                                            name="judul" id="judul"value="{{ $sais->sub_judul_sai }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Deksripsi Sub Judul SaiData</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="desk_sub" name="desk_sub"
                                            id="desk_sub"value="{{ $sais->desk_sub_judul_sai }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Logo SaiData</label>
                                    <div class="col-sm-9">
                                        <input type="" class="form-control" placeholder="" name="logo"
                                            id="logo" value="{{ $sais->logo_sai }}" disabled>
                                        <img src="{{ asset('storage/'.$sais->logo_sai) }}" alt=""
                                        class="object-contain" width="200px" height="120px">
                                    </div>
                                </div>
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
