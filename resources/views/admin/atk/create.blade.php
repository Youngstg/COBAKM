@extends('layouts.admin.app')

@section('title', 'Buat Artikel Baru')

@section('css')
<link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .select2-selection {
        background-color: #343A40 !important;
    }

    .select2-selection__choice {
        background-color: #3F6791 !important;
    }
</style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
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
    });

    let judul = document.getElementById("judul");
    let slug = document.getElementById("slug");
    let slug_message = document.getElementById("slug-message");

    let submit = document.getElementById("submit");

    judul.onchange = function () {
        let j = new XMLHttpRequest();
        j.open("GET", "/admin/artikel/create-slug?mode=create&judul=" + judul.value, true);
        j.onreadystatechange = function () {

            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                slug.value = data.slug;

                slug.classList.remove('is-invalid');
                slug.classList.add('is-valid');

                slug_message.innerHTML = data.message;
                slug_message.classList.remove('invalid-tooltip');
                slug_message.classList.add('valid-tooltip');
                slug_message.style.display = 'block';

                submit.removeAttribute('disabled', 'disabled');
            }
        };
        j.send();
    }

    function string_to_slug(str) {
        str = str.replace(/^\s+|\s+$/g, '');
        str = str.toLowerCase();

        str = str.replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        return str;
    }

    slug.onchange = function () {
        slug.value = string_to_slug(slug.value);
        if (slug.value == "") {
            slug_message.innerHTML = "Slug harus diisi.";
            slug.classList.remove('is-valid');
            slug.classList.add('is-invalid');

            slug_message.classList.remove('valid-tooltip');
            slug_message.classList.add('invalid-tooltip');
            slug_message.style.display = 'block';

            submit.setAttribute('disabled', 'disabled');
            return 0;
        }

        let s = new XMLHttpRequest();

        s.open("GET", "/admin/artikel/check-slug?mode=create&slug=" + slug.value, true);

        s.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                slug_message.innerHTML = data.message;



                if (data.unique == 0) {
                    slug.classList.remove('is-valid');
                    slug.classList.add('is-invalid');

                    slug_message.classList.remove('valid-tooltip');
                    slug_message.classList.add('invalid-tooltip');
                    slug_message.style.display = 'block';

                    submit.setAttribute('disabled', 'disabled');
                } else {
                    slug.classList.remove('is-invalid');
                    slug.classList.add('is-valid');

                    slug_message.classList.remove('invalid-tooltip');
                    slug_message.classList.add('valid-tooltip');
                    slug_message.style.display = 'block';

                    submit.removeAttribute('disabled', 'disabled');
                }
            }
        };
        s.send();
    }

    let nowDate = new Date();
    let today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), nowDate.getHours(), nowDate
        .getMinutes(), nowDate.getSeconds(), 0, 0, 0, 0, 0, 0, 0);

    let tgl_publish = $('#tgl_publish');

    tgl_publish.daterangepicker({
        "minDate": today,
        "singleDatePicker": true,
        "showDropdowns": true,
        "timePicker": true,
        "timePicker24Hour": true,
        "timePickerSeconds": true,
        "locale": {
            "format": "DD-MM-YYYY kk:mm:ss",
            "separator": " - ",
            "applyLabel": "Tetapkan",
            "cancelLabel": "Batal",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "Min",
            "daysOfWeek": [
                "Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"
            ],
            "monthNames": [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
                "November", "Desember"
            ],
            "firstDay": 1
        },
        "drops": "auto"
    });

    tgl_publish.val('');

    tgl_publish.change(function () {
        let old_tgl = tgl_publish.val();
        if (old_tgl.substring(11, 13) == '24') {
            tgl_publish.val(old_tgl.substring(0, 11) + '00' + old_tgl.substring(13, 19));
        }
    });

    $("#tgl_publish_kosongkan").click(function () {
        tgl_publish.val('');
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
                        <h3 class="card-title">Buat Artikel Baru</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('admin.artikel.store') }}" enctype='multipart/form-data'>
                        @csrf
                        <div class="card-body" style="overflow-x:overlay;">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input name="judul" value="{{ old('judul') }}" required
                                    class="form-control @error('judul') is-invalid @enderror" id="judul"
                                    placeholder="Masukkan Judul Artikel...">
                                @error('judul')
                                    <div id="judul-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input name="penulis" value="{{ old('penulis') }}" required
                                    class="form-control @error('penulis') is-invalid @enderror" id="penulis"
                                    placeholder="Masukkan Penulis Artikel...">
                                @error('penulis')
                                    <div id="penulis-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <div class="input-group has-validation position-relative">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">https://km.itera.ac.id/artikel/</div>
                                    </div>
                                    <input name="slug" value="{{ old('slug') }}" required
                                        class="form-control @error('slug') is-invalid @enderror" id="slug"
                                        aria-labelledby="slugHelpBlock" placeholder="Masukkan Slug Artikel...">

                                    {{-- PESAN DI BAWAH INPUT SLUG --}}
                                    <div id="slugHelpBlock" class="form-text">
                                        Slug hanya menerima karakter alfabet kecil, angka dan satu tanda strip (-)
                                        setelah setiap
                                        kata, sedangkan spasi dan karakter lainnya akan diubah menjadi tanda strip. <br>
                                        Slug
                                        harus unik, tidak boleh sama dengan artikel lain.
                                    </div>

                                    @if ($errors->has('slug'))
                                        <div id="slug-message" class="error invalid-tooltip" style="display:block;">
                                            {{ $errors->first('slug') }}
                                        </div>
                                    @else
                                        <div id="slug-message" class="error invalid-tooltip" style="display:none;"></div>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="tag_artikel">Tag (opsional)</label>
                                <select name="tag_artikel[]" multiple="multiple" class="select2 form-control"
                                    id="tag_artikel" style="width: 100%;" data-placeholder="Pilih tag...">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->nama_tag }}</option>
                                    @endforeach
                                </select>
                                @error('tag_artikel')
                                    <div id="tag_artikel-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tag yang dicari belum ada? </label>
                                <a href="{{ route('admin.tag-artikel.create') }}" target="_blank"
                                    class="btn btn-primary">
                                    Buat Tag Baru
                                </a>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar (opsional)</label>
                                <input type="file" name="gambar" id="gambar"
                                    class="form-control @error('gambar') is-invalid @enderror">
                                @error('gambar')
                                    <div id="gambar-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                                {{-- <div id="gambarHelpBlock" class="form-text">
                                    Link gambar yang diterima hanya link dari Google Drive dan yang akan disimpan hanya
                                    ID-nya
                                    saja. Pastikan Akses umum/General access gambar pada menu "Bagikan/Share" telah
                                    diubah
                                    menjadi
                                    "Siapa saja yang memiliki link/Anyone with the link" dan Peranan/Role tetap pada
                                    "Pelihat/Viewer."
                                </div> --}}
                            </div>
                            <div class="form-group">
                                <label for="konten">Konten</label>
                                <textarea name="konten" required value="{{ old('konten') }}"
                                    class="form-control custom-txt-area" placeholder="Masukkan konten artikel..."
                                    id="konten">{{ old('konten') }}</textarea>
                                @error('konten')
                                    <div id="konten-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="penulis">Tanggal dan Waktu Terbit (opsional)</label>
                                <div class="input-group">
                                    <input name="tgl_publish"
                                        class="form-control @error('tgl_publish') is-invalid @enderror" id="tgl_publish"
                                        placeholder="Masukkan Tanggal dan Waktu Terbit Artikel...">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary"
                                            id="tgl_publish_kosongkan">Kosongkan</button>
                                    </div>
                                    @error('tgl_publish')
                                        <div id="tgl_publish-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="tgl_publishHelpBlock" class="form-text">
                                        Tanggal dan waktu artikel direncanakan untuk terbit dan dapat diakses, harus
                                        lebih dari
                                        tanggal dan waktu sekarang. Kosongkan jika ingin artikel yang telah dibuat dapat
                                        diakses
                                        dan langsung terbit saat itu juga. <br>
                                        Format: Tanggal-Bulan-Tahun Jam:Menit:Detik WIB
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <label for="features_atk">Features</label><br>
                                <input name="features_atk" checked="{{ old('features_atk') }}"
                                    class=" @error('features_atk') is-invalid @enderror" id="features_atk"
                                    type="checkbox">
                                @error('features_atk')
                                    <div id="desk-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="features_atkHelpBlock" class="form-text">
                                    Silahkan klik jika Aktivitas ingin ditampilkan pada dashboard
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
</section>
@endsection