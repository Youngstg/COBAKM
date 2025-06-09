@extends('layouts.admin.app')

@section('title', 'Tambah Data')

@section('js')
<!-- TinyMCE untuk konten artikel -->
<script src="{{ asset('plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
@endsection

@section('script')
    <script>
        // $(function () {
        //     $('.select2').select2()
        // });
        tinymce.init({
            selector: 'textarea#konten',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar1: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullistforecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            toolbar_mode: 'wrap',
            skin: 'oxide-dark',
            setup: function (editor) {
                editor.on('change', function (e) {
                    editor.save();
                });
            }
            // content_css: 'dark'
        });
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
                            <h3 class="card-title">Tambah Data Penristek</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(auth()->user()->id_role == 888)
                            <form method="POST" action="{{ route('admin.penristek.store') }}"  enctype='multipart/form-data'>
                        @elseif(auth()->user()->id_role == 1000)
                            <form method="POST" action="{{ route('penris.penristek.store') }}"  enctype='multipart/form-data'>
                        @endif
                        <form method="POST" action="{{ route('admin.penristek.store') }}" enctype='multipart/form-data'>
                            @csrf
                            <div class="card-body" style="overflow-x:overlay;">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input name="judul" required value="{{ old('judul') }}"
                                        class="form-control @error('judul') is-invalid @enderror" id="judul"
                                        placeholder="Masukkan Judul..." required>
                                    @error('judul')
                                        <div id="judul-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Konten</label>
                                    <textarea name="deskripsi" required class="form-control custom-txt-area" placeholder="Masukkan konten artikel..." id="konten">{{ old('deskripsi') }}</textarea>
                                </div>
                                @error('deskripsi')
                                    <div id="deskripsi" class="">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" name="gambar" value="{{ old('gambar') }}"
                                        class="form-control @error('gambar') is-invalid @enderror" id="gambar" required>
                                    @error('gambar')
                                        <div id="gambar-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    {{-- <div id="gambarHelpBlock" class="form-text">
                                        Link gambar yang diterima hanya link dari Google Drive. Pastikan Akses umum/General access gambar pada menu "Bagikan/Share" telah diubah menjadi
                                        "Siapa saja yang memiliki link/Anyone with the link" dan Peranan/Role tetap pada "Pelihat/Viewer."
                                    </div> --}}
                                </div>
                                <div class="form-group">
                                    <label for="link_penristek">Link Penristek</label>
                                    <input name="link_penristek" value="{{ old('link_penristek') }}"
                                        class="form-control @error('link_penristek') is-invalid @enderror" id="link_penristek"
                                        placeholder="Masukkan Link link_penristek Aset..." required>
                                    @error('link_penristek')
                                        <div id="link_penristek-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.card -->
@endsection
