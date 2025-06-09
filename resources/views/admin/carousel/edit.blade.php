@extends('layouts.admin.app')
@section('title', 'Edit Carousel')

@section('script')
    <script>
        function previewNewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Carousel</h3>
                        </div>
                        <div class="card-body">
                            @if (Auth::user()->id_role == 1111)
                                <form method="POST" action="{{ route('ekraf.carousel.update', $carousel->id) }}"
                                    enctype="multipart/form-data">
                                @else
                                    <form method="POST" action="{{ route('admin.carousel.update', $carousel->id) }}"
                                        enctype="multipart/form-data">
                            @endif
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                @if ($carousel->image_path)
                                    <div>
                                        <img src="{{ asset("/storage/$carousel->image_path") }}" alt=""
                                            style="max-width: 300px; max-height: 200px;" id="currentImage">
                                        <div id="newImagePreview" style="display:none;">
                                            <img id="newImage" style="max-width: 300px; max-height: 200px;">
                                        </div>
                                    </div>
                                @endif
                                <input type="file" class="form-control-file" id="image" name="image"
                                    accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
