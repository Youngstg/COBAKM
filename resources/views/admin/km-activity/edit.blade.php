@extends('layouts.admin.app')

@section('title', 'Ubah Aktivitas')

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
            selector: 'textarea#deskripsi_kmac',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar1: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            toolbar_mode: 'wrap',
            skin: 'oxide-dark',
            setup: function (editor) {
                var maxChars = 100;

                editor.on('keydown', function (e) {
                    var content = editor.getContent({ format: 'text' });
                    if (content.length >= maxChars && e.keyCode !== 8 && e.keyCode !== 46) {
                        e.preventDefault();
                        editor.notificationManager.open({
                            text: 'Maksimal ' + maxChars + ' karakter.',
                            type: 'warning',
                            timeout: 2000
                        });
                    }
                });

                editor.on('paste', function (e) {
                    var content = editor.getContent({ format: 'text' });
                    var clipboard = (e.clipboardData || window.clipboardData).getData('text');

                    if (content.length + clipboard.length > maxChars) {
                        e.preventDefault();
                        var allowedText = clipboard.substring(0, maxChars - content.length);
                        editor.insertContent(allowedText);

                        editor.notificationManager.open({
                            text: 'Teks yang dipaste terpotong karena melebihi batas ' + maxChars + ' karakter.',
                            type: 'warning',
                            timeout: 2000
                        });
                    }
                });

                editor.on('change', function () {
                    editor.save();
                });
            }
        });

        tinymce.init({
            selector: 'textarea#konten_kmac',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar1: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            toolbar_mode: 'wrap',
            skin: 'oxide-dark',
            setup: function (editor) {
                editor.on('change', function (e) {
                    editor.save();
                });
            }
        });

    let title = document.getElementById("title_kmac");
    let slug = document.getElementById("slug_kmac");
    let slug_message = document.getElementById("slug_kmac-message");

    let old_slug = slug.value;
    let submit = document.getElementById("submit");

    title.onchange = function () {
        let j = new XMLHttpRequest();
        j.open("GET", "/admin/km-activity/create-slug?mode=edit&title=" + title.value + "&id={{ $kmac->id }}", true);
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

        s.open("GET", "/admin/km-activity/check-slug?mode=edit&slug=" + slug.value + "&id={{ $kmac->id }}", true);

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
                }
                else {
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
    let today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    let tgl_pelaksanaan = $('#tgl_pelaksanaan');

    tgl_pelaksanaan.daterangepicker({
        "minDate": "{{ date("d-m-Y H:i:s", strtotime($kmac->created_at)) }}",
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
                "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ],
            "firstDay": 1
        },
        "drops": "auto"
    });
    let val_tgl = {!! ($kmac->tgl_pelaksanaan != $kmac->created_at) ? "'" . date("d-m-Y H:i:s", strtotime($kmac->tgl_pelaksanaan)) . "'" : "''" !!}
    tgl_pelaksanaan.val(val_tgl);

    tgl_pelaksanaan.change(function () {
        let old_tgl = tgl_pelaksanaan.val();
        if (old_tgl.substring(11, 13) == '24') {
            tgl_pelaksanaan.val(old_tgl.substring(0, 11) + '00' + old_tgl.substring(13, 19));
        }
    });

    $("#tgl_pelaksanaan_kosongkan").click(function () {
        tgl_pelaksanaan.val('');
    });

    function previewNewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
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
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-12 form-wrapper">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Aktivitas</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('admin.km-activity.update', $kmac->slug_kmac) }}"
                        enctype='multipart/form-data'>
                        @csrf
                        @method('PUT')
                        <div class="card-body" style="overflow-x:overlay;">
                            <div class="form-group">
                                <label for="title_kmac">Tema</label>
                                <input name="title_kmac" value="{{ old('title_kmac', $kmac->title_kmac) }}" required
                                    class="form-control @error('title_kmac') is-invalid @enderror" id="title_kmac"
                                    placeholder="Masukkan Tema Aktivitas...">
                                @error('title_kmac')
                                    <div id="title_kmac-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ketuplak_kmac">Ketua Pelaksana (Optional)</label>
                                <input name="ketuplak_kmac" value="{{ old('ketuplak_kmac', $kmac->ketuplak_kmac) }}"
                                    class="form-control @error('ketuplak_kmac') is-invalid @enderror" id="ketuplak_kmac"
                                    placeholder="Masukkan Ketua Pelaksana...">
                                @error('ketuplak_kmac')
                                    <div id="ketuplak_kmac-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug_kmac">Slug</label>
                                <div class="input-group has-validation position-relative">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">https://km.itera.ac.id/activity/</div>
                                    </div>
                                    <input name="slug_kmac" value="{{ old('slug_kmac', $kmac->slug_kmac) }}" required
                                        class="form-control @error('slug_kmac') is-invalid @enderror" id="slug_kmac"
                                        aria-labelledby="slug_kmacHelpBlock" placeholder="Masukkan Slug Aktivitas...">

                                    {{-- PESAN DI BAWAH INPUT SLUG --}}
                                    <div id="slugHelpBlock" class="form-text">
                                        Slug hanya menerima karakter alfabet kecil, angka dan satu tanda strip (-)
                                        setelah setiap
                                        kata, sedangkan spasi dan karakter lainnya akan diubah menjadi tanda strip. <br>
                                        Slug
                                        harus unik, tidak boleh sama dengan aktivitas lain.
                                    </div>

                                    @if ($errors->has('slug_kmac'))
                                        <div id="slug_kmac-message" class="error invalid-tooltip" style="display:block;">
                                            {{ $errors->first('slug_kmac') }}
                                        </div>
                                    @else
                                        <div id="slug_kmac-message" class="error invalid-tooltip" style="display:none;">
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="tag_kmac">Tag</label>
                                <select name="tag_kmac[]" class="form-control" id="tag_kmac"
                                    style="width: 100%;" required>

                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $kmac_tags) ? 'selected' : '' }}>{{ $tag->nama_tag }}</option>
                                    @endforeach

                                </select>
                                @error('tag_kmac')
                                    <div id="tag_kmac-error" class="error invalid-feedback">{{ $message }}</div>
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
                                <label for="gambar_kmac">Gambar</label><br>
                                @if($kmac->gambar_kmac)
                                    <div>
                                        <img src="{{ asset("/storage/$kmac->gambar_kmac") }}" alt="Gambar {{$kmac->title_kmac}}"
                                            style="max-width: 200px; max-height: 200px;" id="currentImage">
                                        <div id="newImagePreview" style="display:none;">
                                            <img id="newImage" style="max-width: 100px; max-height: 100px;">
                                        </div>
                                    </div>
                                @endif
                                <input type="file" name="gambar_kmac" id="gambar_kmac"
                                    class="form-control @error('gambar_kmac') is-invalid @enderror" accept="image/*" onchange="previewNewImage(event)">
                                @error('gambar_kmac')
                                    <div id="gambar_kmac-error" class="error invalid-feedback">{{ $message }}</div>
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
                                <label for="konten_kmac">Konten Aktivitas</label>
                                <textarea name="konten_kmac" required
                                    value="{{ old('konten_kmac', $kmac->konten_kmac) }}"
                                    class="form-control custom-txt-area" placeholder="Masukkan konten_kmac artikel..."
                                    id="konten_kmac">{{ old('konten_kmac', $kmac->konten_kmac) }}</textarea>
                                @error('konten_kmac')
                                    <div id="konten_kmac-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="konten_kmacHelpBlock" class="form-text">
                                    Disarankan ditulis dengan Format:
                                    <br>
                                    <ol>
                                        <li>Heading 3, 4, ata 5</li>
                                        <li>Paragraf lengkap</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi_kmac">Deskripsi Singkat Aktivitas</label>
                                <textarea name="deskripsi_kmac" required
                                    value="{{ old('deskripsi_kmac', $kmac->deskripsi_kmac) }}"
                                    class="form-control custom-txt-area"
                                    placeholder="Masukkan deskripsi_kmac artikel..."
                                    id="deskripsi_kmac">{{ old('deskripsi_kmac', $kmac->deskripsi_kmac) }}</textarea>
                                @error('deskripsi_kmac')
                                    <div id="deskripsi_kmac-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="deskripsi_kmacHelpBlock" class="form-text">
                                    Disarankan ditulis dengan Format:
                                    <br>
                                    <ol>
                                        <li>Heading 3, 4, ata 5</li>
                                        <li>Paragraf singkat</li>
                                        <li>Max 100 huruf</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tgl_pelaksanaan">Tanggal dan Waktu Kegiatan dilaksanakan</label>
                                <div class="input-group">
                                    <input name="tgl_pelaksanaan"
                                        class="form-control @error('tgl_pelaksanaan') is-invalid @enderror"
                                        id="tgl_pelaksanaan"
                                        placeholder="Masukkan Tanggal dan Waktu Aktivitas dilaksanakan">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary"
                                            id="tgl_pelaksanaan_kosongkan">Kosongkan</button>
                                    </div>
                                    @error('tgl_pelaksanaan')
                                        <div id="tgl_pelaksanaan-error" class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="tgl_pelaksanaanHelpBlock" class="form-text">
                                    Tanggal dan waktu aktivitas direncanakan untuk dimula, harus
                                    lebih dari
                                    tanggal dan waktu sekarang <br>
                                    Format: Tanggal-Bulan-Tahun Jam:Menit:Detik WIB
                                </div>
                            </div>
                            <div class="">
                                <label for="features_kmac">Features</label><br>
                                <input name="features_kmac" {{ $kmac->features_kmac == '1' ? 'checked' : ''}}
                                    class=" @error('features_kmac') is-invalid @enderror" id="features_kmac"
                                    type="checkbox">
                                @error('features_kmac')
                                    <div id="desk-error" class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="features_kmacHelpBlock" class="form-text">
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
