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
                            <h3 class="card-title">Tambah Data Produk</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(auth()->user()->id_role == 888)
                            <form method="POST" action="{{ route('admin.produk.store') }}"  enctype='multipart/form-data'>
                        @elseif(auth()->user()->id_role == 1111)
                            <form method="POST" action="{{ route('ekraf.produk.store') }}"  enctype='multipart/form-data'>
                        @endif
                            <h1>On development</h1>
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
