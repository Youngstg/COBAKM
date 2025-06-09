@extends('layouts.admin.app')

@section('title', 'Read Arsip')

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
                            <h3 class="card-title">Arsip</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @csrf
                        @method('PUT')
                        <div class="card-body" style="overflow-x:overlay;">
                            <div class="form-group">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Judul Arsip</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Judul Arsip" name="judul"
                                            id="judul"value="{{ $arps->judul_arp }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Link Arsip</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="link_arp" name="link_arp"
                                            id="link_arp"value="{{ $arps->link_arp }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Tanggal Arsip</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="tanggal_arp" name="tgl_arp"
                                            id="tgl_arp"value="{{ $arps->tgl_arp }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Publisher Arsip</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="publisher_arp"
                                            name="publisher_arp" id="publisher_arp"value="{{ $arps->publisher_arp }}"
                                            disabled>
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
