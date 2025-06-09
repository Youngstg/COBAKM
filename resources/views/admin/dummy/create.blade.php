@extends('layouts.admin.app')

@section('title', 'Tambah Alur Sistem')

@section('script')
<script>
    function previewNewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('newImage');
            output.src = reader.result;
            document.getElementById('newImagePreview').style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
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
                        <h3 class="card-title">Tambah Alur Sistem</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if($dummy->count() < 4)
                        <form method="POST" action="{{ route('admin.dummy.store') }}" enctype='multipart/form-data'>
                            @csrf
                            <div class="card-body" style="overflow-x:overlay;">
                                <div class="form-group">
                                    <label for="nama_dummy">Nama Alur</label>
                                    <select name="nama_dummy" class="form-control bg-inherit bg-white" id="nama_dummy"
                                        required>
                                        <option value="">Pilih Alur Sistem</option>
                                        <option value="Banding UKT">Banding UKT</option>
                                        <option value="PIK-R">PIK-R</option>
                                        <option value="Sukma KM">Sukma KM</option>
                                        <option value="Kritik Saran">Kritik Saran</option>
                                        <!-- Tambahkan opsi sesuai kebutuhan -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="link_dummy">Link Alur Sistem</label>
                                    <input type="link" name="link_dummy" class="form-control bg-inherit bg-white"
                                        id="link_dummy" placeholder="Masukkan Nama Dummy...">
                                </div>
                                <div class="form-group">
                                    <label for="foto_dummy">Foto Alur Sistem</label>
                                    <div id="newImagePreview" style="display:none;">
                                        <img id="newImage" style="max-width: 300px; max-height: 200px;">
                                    </div>
                                    <input type="file" name="gambar" id="gambar" class="form-control bg-inherit bg-white"
                                        onchange="previewNewImage(event)" accept="image/*">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    @else
                        <p class="m-4">Anda sudah membuat 4 alur sistem</p>
                    @endif
                </div>
            </div>
</section>
<!-- /.card -->
@endsection