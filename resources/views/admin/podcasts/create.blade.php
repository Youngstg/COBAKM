@extends('layouts.admin.app')
@section('title', 'Buat Podcast Baru')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Buat Podcast Baru</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.podcasts.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="features_podcast">Tampilkan di beranda?</label>
                                <div>
                                    <input type="checkbox" id="features_podcast" name="features_podcast">
                                    <label for="features_podcast">Ya</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="top_podcast">Tampilkan di top page?</label>
                                <div>
                                    <input type="checkbox" id="top_podcast" name="top_podcast">
                                    <label for="top_podcast">Ya</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="judul">Nama Podcast</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    placeholder="Masukkan judul podcast" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Podcast</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi"
                                    placeholder="Deskripsi podcast" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori Podcast</label>
                                <input type="text" class="form-control" id="kategori" name="kategori"
                                    placeholder="Masukan kategori podcast. Contoh: Politik, Sosial, Ilmu Pengetahuan"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="narasumber">Narasumber</label>
                                <input type="text" class="form-control" id="narasumber" name="narasumber"
                                    placeholder="Masukkan nama lengkap narasumber. Input lebih dari 1 menggunakan (,)"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="pewawancara">Pewawancara</label>
                                <input type="text" class="form-control" id="pewawancara" name="pewawancara"
                                    placeholder="Masukkan nama lengkap pewawancara. Input lebih dari 1 menggunakan (,)"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="link">Link Podcast</label>
                                <input type="url" class="form-control" id="link" name="link"
                                    placeholder="Masukkan link youtube podcast" required>
                            </div>
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail Video</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail"
                                            onchange="previewImage(event)" required>
                                        <label class="custom-file-label" for="thumbnail">Upload Thumbnail</label>
                                    </div>
                                </div>
                                <img id="thumbnail-preview" src="#" alt="Thumbnail Preview"
                                    style="display: none; margin-top: 10px; max-height: 200px;">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('thumbnail-preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection