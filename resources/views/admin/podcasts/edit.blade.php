@extends('layouts.admin.app')
@section('title', 'Edit Podcast')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Podcast</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.podcasts.update', $podcast->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="features_podcast">Tampilkan di beranda?</label>
                                <div>
                                    <input type="checkbox" id="features_podcast" name="features_podcast" {{ $podcast->features_podcast ? 'checked' : '' }}>
                                    <label for="features_podcast">Ya</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="top_podcast">Tampilkan di top page</label>
                                <div>
                                    <input type="checkbox" id="top_podcast" name="top_podcast" {{ $podcast->top_podcast ? 'checked' : '' }}>
                                    <label for="top_podcast">Ya</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="judul">Nama Podcast</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    value="{{ $podcast->judul }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Podcast</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi"
                                    required>{{ $podcast->deskripsi }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori Podcast</label>
                                <input type="text" class="form-control" id="kategori" name="kategori"
                                    value="{{ $podcast->kategori }}" required>
                            </div>
                            <div class="form-group">
                                <label for="narasumber">Narasumber</label>
                                <input type="text" class="form-control" id="narasumber" name="narasumber"
                                    value="{{ $podcast->narasumber }}" required>
                            </div>
                            <div class="form-group">
                                <label for="pewawancara">Pewawancara</label>
                                <input type="text" class="form-control" id="pewawancara" name="pewawancara"
                                    value="{{ $podcast->pewawancara }}" required>
                            </div>
                            <div class="form-group">
                                <label for="link">Link Podcast</label>
                                <input type="url" class="form-control" id="link" name="link"
                                    value="{{ $podcast->link }}" required>
                            </div>
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail Video</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail"
                                            onchange="previewImage(event)">
                                        <label class="custom-file-label" for="thumbnail">Upload Thumbnail</label>
                                    </div>
                                </div>
                                <img id="thumbnail-preview" src="{{ asset('storage/' . $podcast->thumbnail) }}"
                                    alt="Thumbnail Preview"
                                    style="display: block; margin-top: 10px; max-height: 200px;">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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