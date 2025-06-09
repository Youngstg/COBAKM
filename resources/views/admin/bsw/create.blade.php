@extends('layouts.admin.app')

@section('title', 'Tambah Beasiswa')

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
              <h3 class="card-title">Tambah Beasiswa</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if(auth()->user()->id_role == 888)
                <form method="POST" action="{{ route('admin.beasiswa.store') }}"  enctype='multipart/form-data'>
            @elseif(auth()->user()->id_role == 1000)
                <form method="POST" action="{{ route('penris.beasiswa.store') }}"  enctype='multipart/form-data'>
            @endif
                @csrf
                <div class="card-body" style="overflow-x:overlay;">
                    <div class="form-group">
                        <label for="judul_bsw">Judul Beasiswa</label>
                        <input type="text" name="judul_bsw" class="form-control @error('judul_bsw') is-invalid @enderror" id="judul_bsw" placeholder="Masukkan judul beasiswa..." required value="{{ old('judul_bsw') }}">
                        @error('judul_bsw')
                        <div id="judul_bsw-error" class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gambar_bsw">link Gambar</label>
                        <input type="file" name="gambar" class="form-control @error('gambar_bsw') is-invalid @enderror" id="gambar" required>
                        @error('gambar_bsw')
                            <div id="gambar_bsw-error" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        {{-- <div id="gambarHelpBlock" class="form-text">
                            Link gambar yang diterima hanya link dari Google Drive. Pastikan Akses umum/General access gambar pada menu "Bagikan/Share" telah diubah menjadi
                            "Siapa saja yang memiliki link/Anyone with the link" dan Peranan/Role tetap pada "Pelihat/Viewer."
                        </div> --}}
                    </div>

                    <div class="form-group">
                        <label for="konten_bsw">Konten</label>
                        <textarea name="konten_bsw" required class="form-control custom-txt-area" placeholder="Masukkan konten artikel..." id="konten">{{ old('konten_bsw') }}</textarea>
                    </div>
                    @error('konten_bsw')
                        <div id="konten_bsw-error" class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror


                    <p class="bg-danger pl-1">note gunakan input link seperlunya tidak semua harus di isi!!</p>
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="form-group mb-3">
                            <label for="judul_link_bsw_{{ $i }}">Judul Link {{ $i }}</label>
                            <input name="judul_link_bsw_{{ $i }}" class="form-control" id="judul_link_bsw_{{ $i }}" placeholder="Masukkan Judul Link {{ $i }}..." value="{{ old('judul_link_bsw_'.$i) }}">
                            <label for="link_bsw_{{ $i }}">Link {{ $i }}</label>
                            <input name="link_bsw_{{ $i }}" class="form-control" id="link_bsw_{{ $i }}" placeholder="Masukkan Link {{ $i }}..." value="{{ old('link_bsw_'.$i) }}">
                        </div>
                    @endfor
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
