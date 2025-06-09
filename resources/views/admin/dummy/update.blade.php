@extends('layouts.admin.app')

@section('title', 'Ubah Dummy')

@section('script')
<script>
    function previewNewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('newImage');
            output.src = reader.result;
            document.getElementById('newImagePreview').style.display = 'block';
            document.getElementById('currentImage').style.display = 'none';
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
                        <h3 class="card-title">Ubah Dummy <b>{{ $dummy->nama_dummy }}</b></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('admin.dummy.update', $dummy->id) }}"
                        enctype='multipart/form-data'>
                        @method('PUT')
                        @csrf
                        <div class="card-body" style="overflow-x:overlay;">
                            <div class="form-group">
                                <label for="nama_dummy">Nama Alur Sistem</label>
                                <select name="nama_dummy" class="form-control bg-inherit bg-white" id="nama_dummy"
                                    required>
                                    <option value="">Pilih Alur Sistem</option>
                                    <option value="Banding UKT" {{ $dummy->nama_dummy == 'Banding UKT' ? 'selected' : '' }}>Banding UKT</option>
                                    <option value="PIK-R" {{ $dummy->nama_dummy == 'PIK-R' ? 'selected' : '' }}>PIK-R
                                    </option>
                                    <option value="Sukma KM" {{ $dummy->nama_dummy == 'Sukma KM' ? 'selected' : '' }}>
                                        Sukma KM</option>
                                    <option value="Kritik Saran" {{ $dummy->nama_dummy == 'Kritik Saran' ? 'selected' : '' }}>
                                        Kritik Saran</option>
                                    <!-- Tambahkan opsi lain jika diperlukan -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="link_dummy">Link Alur Sistem</label>
                                <input type="link" name="link_dummy" class="form-control bg-inherit bg-white"
                                    id="link_dummy" placeholder="Masukkan link Logo Kabinet..."
                                    value="{{ $dummy->link_dummy }}">
                            </div>
                            <div class="form-group">
                                <label for="foto_dummy">Foto Alur Sistem</label>
                                @if($dummy->foto_dummy)
                                    <div>
                                        <img src="{{ asset("/storage/$dummy->foto_dummy") }}" alt="{{ $dummy->nama_dummy}}"
                                            style="max-width: 300px; max-height: 200px;" id="currentImage">
                                        <div id="newImagePreview" style="display:none;">
                                            <img id="newImage" style="max-width: 300px; max-height: 200px;">
                                        </div>
                                    </div>
                                @endif
                                <input type="file" name="gambar" class="form-control bg-inherit bg-white" id="gambar"
                                    onchange="previewNewImage(event)" accept="image/*">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
</section>
<!-- /.card -->
@endsection