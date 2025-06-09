@extends('layouts.admin.app')

@section('title', 'Edit Ormawa')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Ormawa</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ route('admin.ormawa.update', ['slug' => $ormawa->slug, 'type' => $type]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Kategori Ormawa</label>
                                <div>
                                    <label class="mr-2">
                                        <input type="radio" name="kategori[]" value="HMPS" {{ $type == 'HMPS' ? 'checked' : '' }}> HMPS
                                    </label>
                                    <label>
                                        <input type="radio" name="kategori[]" value="UKM" {{ $type == 'UKM' ? 'checked' : '' }}> UKM
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_ormawa">Nama Ormawa</label>
                                <input type="text" class="form-control" id="nama_ormawa" name="nama_ormawa"
                                    value="{{ $ormawa->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_ormawa">Deskripsi Ormawa</label>
                                <textarea class="form-control" id="deskripsi_ormawa"
                                    name="deskripsi_ormawa">{{ $ormawa->details }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="ketua_ormawa">Ketua Ormawa</label>
                                <input type="text" class="form-control" id="ketua_ormawa" name="ketua_ormawa"
                                    value="{{ $ormawa->ketua }}" required>
                            </div>
                            <div class="form-group">
                                <label for="dies_natalis">Dies Natalis Ormawa</label>
                                <input type="text" class="form-control" id="dies_natalis" name="dies_natalis"
                                    value="{{ $ormawa->dies_natalis }}" required>
                            </div>
                            <div class="form-group">
                                <label for="website">Link Website Ormawa</label>
                                <input type="url" class="form-control" id="website" name="website"
                                    value="{{ $ormawa->website }}">
                            </div>
                            <div class="form-group">
                                <label>Social Media Ormawa</label>
                                <input type="url" class="form-control mb-2" name="linkedin"
                                    value="{{ $ormawa->linkedin }}" placeholder="LinkedIn">
                                <input type="url" class="form-control mb-2" name="instagram"
                                    value="{{ $ormawa->instagram }}" placeholder="Instagram">
                                <input type="url" class="form-control" name="youtube" value="{{ $ormawa->youtube }}"
                                    placeholder="YouTube">
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo Ormawa</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="logo" name="logo"
                                            onchange="previewImage(event)">
                                        <label class="custom-file-label" for="logo">Upload Logo</label>
                                    </div>
                                </div>
                                @if($ormawa->image)
                                    <div class="mt-2">
                                        <img id="logo-preview" src="{{ asset('storage/' . $ormawa->image) }}" alt="Logo"
                                            style="max-height: 200px;">
                                    </div>
                                @endif
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
            var output = document.getElementById('logo-preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    document.querySelector('form').addEventListener('submit', function (event) {
        const urls = ['website', 'linkedin', 'instagram', 'youtube'];
        urls.forEach(function (id) {
            const input = document.getElementById(id);
            if (input && input.value && !input.value.startsWith('http://') && !input.value.startsWith('https://')) {
                input.value = 'https://' + input.value;
            }
        });
    });
</script>
@endsection