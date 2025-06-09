@extends('layouts.admin.app')
@section('title', 'Tambah Carousel')
@section('script')
    <script>
        function previewNewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('newImage');
                output.src = reader.result;
                document.getElementById('newImagePreview').style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Carousel</h3>
                        </div>
                        <div class="card-body">
                            @if (Auth::user()->id_role == 1111)
                                <form method="POST" action="{{ route('ekraf.carousel.store') }}"
                                    enctype="multipart/form-data">
                                @else
                                    <form method="POST" action="{{ route('admin.carousel.store') }}"
                                        enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <div id="newImagePreview" style="display:none;">
                                    <img id="newImage" style="max-width: 300px; max-height: 200px;">
                                </div>
                                <input type="file" class="form-control-file mt-2" onchange="previewNewImage(event)"
                                    id="image" name="image" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
