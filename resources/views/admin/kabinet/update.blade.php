@extends('layouts.admin.app')

@section('title', 'Tambah Kabinet')

@section('script')
<script>
    function previewNewImage(event, name) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById(`newImage${name}`);
            output.src = reader.result;
            document.getElementById(`newImagePreview${name}`).style.display = 'block';
            document.getElementById(`currentImage${name}`).style.display = 'none';
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
                        <h3 class="card-title">Edit Kabinet</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('admin.kabinet.update', $kbt->slug_kbt) }}"
                        enctype='multipart/form-data'>
                        @csrf
                        @method('PUT')
                        <div class="card-body" style="overflow-x:overlay;">
                            <div class="form-group">
                                <label for="nama_kbt">Nama Kabinet</label>
                                <input type="text" name="nama_kbt"
                                    class="form-control @error('nama_kbt') is-invalid @enderror" id="nama_kbt"
                                    placeholder="Masukkan Nama Kabinet contoh: Gasendra" required
                                    value="{{ old('nama_kbt', $kbt->nama_kbt) }}">
                                @error('nama_kbt')
                                    <div id="nama_kbt-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="nana_kbtHelpBlock" class="form-text">
                                    Hanya nama kabinet saja, tidak perlu didahulukan kata 'Kabinet'
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nama_presma">Nama Presiden Mahasiswa</label>
                                <input type="text" name="nama_presma"
                                    class="form-control @error('nama_presma') is-invalid @enderror" id="nama_presma"
                                    placeholder="Masukkan Nama Presiden Mahasiswa..." required
                                    value="{{ old('nama_presma', $kbt->nama_presma) }}">
                                @error('nama_presma')
                                    <div id="nama_presma-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="prodi_presma">Prodi Presiden Mahasiswa</label>
                                <input type="text" name="prodi_presma"
                                    class="form-control @error('prodi_presma') is-invalid @enderror" id="prodi_presma"
                                    placeholder="Masukkan Program Studi Presiden Mahasiswa..." required
                                    value="{{ old('prodi_presma', $kbt->prodi_presma) }}">
                                @error('prodi_presma')
                                    <div id="prodi_presma-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tahun_kbt">Tahun Kabinet</label>
                                <input type="number" name="tahun_kbt"
                                    class="form-control @error('tahun_kbt') is-invalid @enderror" id="tahun_kbt"
                                    placeholder="Masukkan Tahun awal saja" required
                                    value="{{ old('tahun_kbt', $kbt->tahun_kbt) }}">
                                @error('tahun_kbt')
                                    <div id="tahun_kbt-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="logo_kbt">Logo Kabinet</label>
                                @if($kbt->logo_kbt)
                                    <div>
                                        <img src="{{ asset("$kbt->logo_kbt") }}" alt="Gambar {{$kbt->nama_kbt}}"
                                            style="max-width: 200px; max-height: 200px;" id="currentImageLogo">
                                        <div id="newImagePreviewLogo" style="display:none;">
                                            <img id="newImageLogo" style="max-width: 100px; max-height: 100px;">
                                        </div>
                                    </div>
                                @endif
                                <input name="logo_kbt" class="form-control @error('logo_kbt') is-invalid @enderror"
                                    id="logo_kbt" type="file" accept="image/*"
                                    onchange="previewNewImage(event, 'Logo')">
                                @error('logo_kbt')
                                    <div id="ikon-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="logoHelpBlock" class="form-text">
                                    Masukkan gambar dengan maksimal 6MB.
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="foto_kbt">Foto Organigram</label>
                                @if($kbt->foto_kbt)
                                    <div>
                                        <img src="{{ asset("$kbt->foto_kbt") }}" alt="Organigram {{$kbt->nama_kbt}}"
                                            style="max-width: 200px; max-height: 200px;" id="currentImageFoto">
                                        <div id="newImagePreviewFoto" style="display:none;">
                                            <img id="newImageFoto" style="max-width: 100px; max-height: 100px;">
                                        </div>
                                    </div>
                                @endif
                                <input name="foto_kbt" class="form-control @error('foto_kbt') is-invalid @enderror"
                                    id="gambar" type="file" accept="image/*" onchange="previewNewImage(event, 'Foto')">
                                @error('foto_kbt')
                                    <div id="ikon-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="logoHelpBlock" class="form-text">
                                    Masukkan gambar dengan maksimal 10MB.
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="desk_kbt">Deskripsi Kabinet</label>
                                <textarea name="desk_kbt"
                                    class="form-control custom-txt-area @error('desk_kbt') is-invalid @enderror"
                                    value="{{ old('desk_kbt') }}" id="desk_kbt"
                                    placeholder="Masukkan Deskripsi Kabinet">{{ old('desk_kbt', $kbt->desk_kbt) }}</textarea>
                                @error('desk_kbt')
                                    <div id="desk-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label for="status_kbt">Status Logo Kabinet</label><br>
                                <input name="status_kbt" {{$kbt->status_kbt == '1' ? 'checked' : ''}}
                                    class=" @error('status_kbt') is-invalid @enderror" id="status_kbt" type="checkbox">
                                @error('status_kbt')
                                    <div id="desk-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="status_kbtHelpBlock" class="form-text">
                                    Silahkan klik jika logo kabinet akan menjadi logo utama.
                                </div>
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