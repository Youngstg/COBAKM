@extends('layouts.admin.app')

@section('title', 'Ubah Beasiswa')

@section('css')
<!-- Select2 untuk tag artikel -->
<link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('js')
<!-- Select2 untuk tag artikel -->
<script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- TinyMCE untuk konten artikel -->
<script src="{{ asset('plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
@endsection

@section('script')
    <script>
        $(function () {
            $('.select2').select2()
        });
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

    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                $(this).remove();
            });
        }, 4000);
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
              <h3 class="card-title">Ubah Beasiswa <b>{{ $bsws -> judul_bsw }}</b></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
                @isset($Error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ $Error }}
                    <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endisset
                @if(auth()->user()->id_role == 888)
                    <form method="POST" action="{{ route('admin.beasiswa.update', $bsws -> slug_bsw) }}"  enctype='multipart/form-data'>
                @elseif(auth()->user()->id_role == 1000)
                    <form method="POST" action="{{ route('penris.beasiswa.update', $bsws -> slug_bsw) }}"  enctype='multipart/form-data'>
                @endif
                @method('PUT')
                @csrf
                <div class="card-body" style="overflow-x:overlay;">
                    <div class="form-group">
                        <label for="judul_bsw">Judul Beasiswa</label>
                        <input type="text" name="judul_bsw" class="form-control @error('judul_bsw') is-invalid @enderror" id="judul_bsw" placeholder="Masukkan judul beasiswa..." value="{{ $bsws->judul_bsw }}" required>
                        @error('judul_bsw')
                            <div id="judul_bsw-error" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="gambar_bsw">link Gambar</label>
                        <img src="{{ asset('storage/'.$bsws->gambar_bsw) }}" alt="{{ $bsws->gambar_bsw }}" style="width: 100px;">
                        <input type="file" name="gambar" id="gambar" class="form-control @error('gambar_bsw') is-invalid @enderror">
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
                        <textarea name="konten_bsw" required class="form-control custom-txt-area" placeholder="Masukkan konten artikel..." id="konten">{{ $bsws->konten_bsw }}</textarea>
                    </div>
                    @error('konten_bsw')
                    <div id="konten_bsw-error" class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror


                    {{-- <p class="bg-danger p-0.5">note gunakan input link seperlunya tidak semua harus di isi!!</p> --}}
                    @foreach ($link_bsws as $link_bsw)
                        <div class="form-group">
                            <label for="judul_link_bsw_{{ $loop->iteration }}">Judul Link {{ $loop->iteration }}</label>
                            <input name="judul_link_bsw_{{ $loop->iteration }}" class="form-control" id="judul_link_bsw_{{ $loop->iteration }}" placeholder="Masukkan Judul Link {{ $loop->iteration }}..." value="{{ $link_bsw->judul_link }}">
                            <label for="link_bsw_{{  $loop->iteration }}">Link {{  $loop->iteration }}</label>
                            <input type="text" name="link_bsw_{{  $loop->iteration }}" class="form-control" id="link_bsw_{{  $loop->iteration }}" placeholder="Masukkan Link {{  $loop->iteration }}..." value="{{ $link_bsw->link }}">
                            <input type="hidden" name="id_{{  $loop->iteration }}" id="id_{{  $loop->iteration }}" placeholder="Masukkan Link {{  $loop->iteration }}..." value="{{ $link_bsw->id }}">
                        </div>
                    @endforeach
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
