@extends('layouts.admin.app')

@section('title', 'Ubah Produk')

@section('js')
<!-- TinyMCE untuk konten artikel -->
<script src="{{ asset('plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'cms-gray': '#454D55',
                    'cms-red': '#e34b3c',
                    'cms-light-gray': '#d9d9d9',
                    'cms-dark-gray': '#343a40',
                    'cms-darker-gray': '#2F3439',
                    'cms-text-gray': '#6C757D',
                    'cms-blue': '#3f6791',
                },
            },
        },
    }
</script>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-12 form">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Produk</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if (auth()->user()->id_role == 888)
                        <form method="POST" action="{{ route('admin.produk.update', $produk->id) }}"
                            enctype='multipart/form-data'>
                    @elseif(auth()->user()->id_role == 1111)
                        <form method="POST" action="{{ route('ekraf.produk.update', $produk->id) }}"
                            enctype='multipart/form-data'>
                    @endif
                            @csrf
                            @method('PUT')
                            <div class="bg-cms-dark-gray px-4 py-2">
                                <div class="mt-2">
                                    <label for="nama_produk">Nama Produk</label>
                                    <br />
                                    <input type="text" name="nama_produk" id="nama_produk"
                                        class="w-full bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1 focus:outline-none"
                                        placeholder="Masukkan nama produk" value="{{ $produk->nama_produk }}" />
                                </div>
                                <div class="deskripsi flex flex-col mt-2 mb-3">
                                    <label for="deskripsi">Deskripsi Produk</label>
                                    <textarea name="deskripsi" id="deskripsi"
                                        class="resize-y rounded-md w-full bg-transparent border-2 border-cms-text-gray">{{ $produk->deskripsi }}</textarea>
                                </div>
                                <h1 class="font-bold text-lg">Jenis Produk</h1>
                                <div id="produk-types">
                                    <div class="flex flex-wrap type-form">
                                        <div class="w-full">
                                            <div class="mt-2">
                                                <label for="nama_varian">Nama Varian Produk</label>
                                                <br />
                                                <input type="text" name="nama_varian" id="nama_varian"
                                                    class="w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1 focus:outline-none"
                                                    placeholder="Masukkan nama jenis produk"
                                                    value="{{ $produk->varianProduk[0]->nama_varian }}" />
                                            </div>
                                        </div>
                                        @foreach($produk->varianProduk as $key => $varian)

                                            <div class="stock-form mr-2">
                                                <div class="mt-2">
                                                    <label for="produk[{{ $key }}][ukuran]">Ukuran Varian Produk</label>
                                                    <br />
                                                    <input type="text" name="produk[{{ $key }}][ukuran]"
                                                        id="produk[{{ $key }}][ukuran]"
                                                        class="w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1 focus:outline-none"
                                                        placeholder="Masukkan ukuran produk"
                                                        value="{{ $varian->ukuran }}" />
                                                </div>
                                                <div class="mt-2">
                                                    <label for="produk[{{ $key }}][stok]">Stok Varian Produk</label>
                                                    <br />
                                                    <input type="number" name="produk[{{ $key }}][stok]"
                                                        id="produk[{{ $key }}][stok]"
                                                        class="w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1 focus:outline-none"
                                                        placeholder="Masukkan stok produk" value="{{ $varian->stok }}" />
                                                </div>

                                                <div class="mt-2">
                                                    <label for="produk[{{ $key }}][harga]">Harga Varian Produk</label>
                                                    <br />
                                                    <input type="number" name="produk[{{ $key }}][harga]"
                                                        id="produk[{{ $key }}][harga]"
                                                        class="w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1 focus:outline-none"
                                                        placeholder="Masukkan harga produk"
                                                        value="{{ old('produk.' . $key . '.harga', $varian->harga) }}" />
                                                </div>

                                                <div class="mt-2" style="display:none;">
                                                    <input type="number" name="produk[{{ $key }}][id]"
                                                        id="produk[{{ $key }}][id]"
                                                        value="{{ old('produk.' . $key . '.id', $varian->id) }}" />
                                                </div>

                                            </div>
                                        @endforeach
                                        <div id="add_button0">
                                            <button type="button"
                                                class="h-full w-[100px] border-2 border-white border-dashed ms-2 rounded-md"
                                                onclick="addStockSize(0)">
                                                <i class="bi bi-plus text-4xl"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="container my-3">
                                    <p>Anda <strong class="text-red-500">tidak dapat menghapus</strong> ukuran
                                        varian yang sudah anda, apabila anda
                                        tidak ingin menampilkannya di dashboard silahkan <strong
                                            class="text-red-500">ubah stok varian produk menjadi
                                            0</strong>.
                                    </p>
                                </div>
                                <div id="imageUploadSection" data-image-count="{{ $produk->photos->count() }}">
                                    <div class="text-lg font-semibold mb-4">
                                        Foto Produk (<span id="imageCount">{{ $produk->photos->count() }}</span>/3)
                                    </div>
                                    <div class="flex space-x-4" id="imageContainer">
                                        @foreach(range(0, 2) as $i)
                                            <div class="image-container relative" data-index="{{ $i }}">
                                                <input type="file" name="foto_produk[]" id="upload{{ $i + 1 }}"
                                                    class="hidden" onchange="uploadImage(event, {{ $i + 1 }})"
                                                    accept="image/*">

                                                <label for="upload{{ $i + 1 }}"
                                                    class="w-full h-24 bg-cms-blue text-md flex justify-center items-center cursor-pointer text-white {{ isset($produk->photos[$i]) ? 'hidden' : '' }}">
                                                    Tambah foto
                                                </label>

                                                <img id="preview{{ $i + 1 }}"
                                                    src="{{ isset($produk->photos[$i]) ? asset('storage/' . $produk->photos[$i]->url_photo) : '#' }}"
                                                    class="w-full h-24 object-cover {{ isset($produk->photos[$i]) ? '' : 'hidden' }}">

                                                <button type="button" onclick="removeImage({{ $i + 1 }})"
                                                    class="image absolute top-0 right-0 bg-red-500 text-white w-6 h-6 flex items-center justify-center {{ isset($produk->photos[$i]) ? '' : 'hidden' }}">
                                                    x
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                            </div>
                            <div class="submit bg-cms-darker-gray m-0 px-4 py-2 mb-5">
                                <button type="submit" class="bg-cms-blue px-3 py-2 rounded-md">
                                    Update
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    function sizeAdd() {
        const input =
            '<div class=""> <input type = "text" name = "ukuran_produk[]" class = "w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-2" placeholder = "Masukkan ukuran produk" > <button class = "bg-cms-red py-1.5 px-3 rounded-md hover:bg-red-700" type="button" onclick="sizeDelete()"><i class = "bi bi-trash3"></i> </button></div>';
        const size = document.getElementById('size');
        size.insertAdjacentHTML('beforeend', input);
    }

    function sizeDelete() {
        const size = document.getElementById('size');
        const sizeInputs = size.querySelectorAll(
            'input[name="produk[0][]"]'
        );
        if (sizeInputs.length > 1) {
            sizeInputs[sizeInputs.length - 1].parentElement.remove();
        }
    }

    async function uploadBtn(target) {
        const input = document.getElementById(target);
        const text = document.getElementById(`${target}Btn`);
        input.click();
        input.onchange = function () {
            const filename =
                input.files.length > 0 ?
                    input.files[0].name :
                    'No file chosen';
            text.innerHTML = filename;
        };
    }


    function addStockSize(itype) {
        const i = document.querySelectorAll('.stock-form').length;
        const form = `<div class="stock-form mr-2">
                                       <div class="mt-2">
                                       <label for="ukuran_produk_stock${i}">Ukuran Varian Produk</label>
                                   <br>
                                   <input type="text" name="produk[${i}][ukuran]" id="ukuran_produk_stock${i}"
                                   class="w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1"
                                   placeholder="Masukkan ukuran produk">
                               </div>
                                 <div class="mt-2">
                                       <label for="stok_produk${i}">Stok Varian Produk</label>
                                   <br>
                                   <input type="number" name="produk[${i}][stok]" id="stok_produk${i}"
                                   class="w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1"
                                   placeholder="Masukkan stok produk">
                               </div>
                                 <div class="mt-2">
                                    <label for="harga_produk${i}">Harga Varian Produk</label>
                                   <br>
                                   <input type="number" name="produk[${i}][harga]" id="harga_produk${i}"
                                   class="w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1"
                                   placeholder="Masukkan harga produk">
                                 </div>
                                       <div class="flex justify-center">
                                           <button type="button" class="bg-cms-red py-1.5 px-3 rounded-md hover:bg-red-700 mt-2" onclick="stockSizeDelete()">
                                               <i class="bi bi-trash3"></i>
                                           </button>
                                       </div>
                                   </div>`;
        const size = document.getElementById(`add_button${itype}`);
        size.insertAdjacentHTML('beforebegin', form);
        console.log(i);
    }

    function stockSizeDelete() {
        const size = document.querySelector('.type-form');
        const sizeInputs = size.querySelectorAll('.stock-form');
        if (sizeInputs.length > 1) {
            sizeInputs[sizeInputs.length - 1].remove();
        }
    }

    function typeAdd() {
        const i = document.querySelectorAll('.type-form').length;
        const typeForm = `
                                       <div class="type-form">
                                             <div class="form flex flex-wrap">
                                                <div class="w-full">
                                                   <div class="mt-2">
                                                                                       <label for="nama_varian">Nama Varian Produk</label>
                                                                                   <br>
                                                                                   <input type="text" name="nama_varian" id="nama_varian"
                                                                                   class="w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1 focus:outline-none "
                                                                                   placeholder="Masukkan nama jenis produk" value="">
                                                                               </div>
                                                   <div class="mt-2">
                                                                                       <label for="foto_produk[]">Foto Produk</label>
                                                                                   <br>
                                                                                   <button type="button" class="w-[270px] rounded-md flex justify-between" onclick="uploadBtn('foto_produk[]')">
                                                                                   <span id="foto_produk[]Btn"
                                                                                       class="border-2 text-gray-400 border-cms-text-gray w-full h-[38px] text-left ps-2 flex items-center rounded-l-md">
                                                                                       Pilih Foto Produk
                                                                                   </span>
                                                                                   <span
                                                                                       class="bg-cms-blue hover:bg-slate-600 text-white h-[38px] px-6 flex items-center rounded-r-md">Upload</span>
                                                                               </button>
                                                                               <input type="file" name="foto_produk[]" id="foto_produk[]" class="hidden">
                                                                           </div>
                                                </div>
                                                <div class="stock-form">
                                                   <div class="mt-2">
                                                                                       <label for="produk[${i}][0][ukuran]">Ukuran Produk</label>
                                                                                   <br>
                                                                                   <input type="text" name="produk[${i}][0][ukuran]" id="produk[${i}][0][ukuran]"
                                                                                   class="w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1 focus:outline-none "
                                                                                   placeholder="Masukkan ukuran produk" value="">
                                                                               </div>
                                                   <div class="mt-2">
                                                                                       <label for="produk[${i}][0][stok]">Stok Produk</label>
                                                                                   <br>
                                                                                   <input type="text" name="produk[${i}][0][stok]" id="produk[${i}][0][stok]"
                                                                                   class="w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1 focus:outline-none "
                                                                                   placeholder="Masukkan stok produk" value="">
                                                                               </div>
                                                   <div class="mt-2">
                                                                                       <label for="produk[${i}][0][harga]">Harga Produk</label>
                                                                                   <br>
                                                                                   <input type="text" name="produk[${i}][0][harga]" id="produk[${i}][0][harga]"
                                                                                   class="w-[270px] bg-cms-dark-gray border-2 border-cms-text-gray rounded-md py-1 px-2 mt-1 focus:outline-none "
                                                                                   placeholder="Masukkan harga produk" value="">
                                                                               </div>
                                                </div>
                                                <div id="add_button${i}">
                                                   <button type="button" class="h-full w-[100px] border-2 border-white border-dashed ms-2 rounded-md"
                                                      onclick="addStockSize(${i})">
                                                      <i class="bi bi-plus text-4xl"></i>
                                                   </button>
                                                </div>
                                             </div>
                                             <div class="remove-button flex items-center">
                                                   <div class="separator h-[2px] bg-white w-3/4 mt-2 mr-4"></div>
                                                   <button type="button" class="bg-cms-red px-4 py-1" onclick="typeDelete()">
                                                      Hapus Jenis
                                                   </button>
                                             </div>
                                       </div>
                                    </div>
                                    `;
        const add = document.getElementById('type_add');
        add.insertAdjacentHTML('beforebegin', typeForm);
        console.log(i);
    }

    function typeDelete() {
        const size = document.getElementById('produk-types');
        const sizeInputs = size.querySelectorAll('.type-form');
        if (sizeInputs.length > 1) {
            sizeInputs[sizeInputs.length - 1].remove();
        }
    }

    // function updateImageCount() {
    //     const images = document.querySelectorAll('.image:not(.hidden)');
    //     document.getElementById('imageCount').textContent = images.length;
    // }

    function updateImageCount() {
        const images = document.querySelectorAll('.image:not(.hidden)');
        const imageCount = images.length;
        const section = document.getElementById('imageUploadSection');

        section.dataset.imageCount = imageCount;
        document.getElementById('imageCount').textContent = imageCount;

        // Update the UI based on the new image count
        updateImageContainers();
    }

    function uploadImage(event, num) {
        event.preventDefault();
        const file = event.target.files[0];
        const preview = document.getElementById('preview' + num);
        const label = document.querySelector(`label[for=upload${num}]`);
        const removeBtn = document.querySelector(`button[onclick="removeImage(${num})"]`);

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (label) label.classList.add('hidden');
                removeBtn.classList.remove('hidden');
                updateImageCount();
            };
            reader.readAsDataURL(file);
        }
    }

    function removeImage(num) {
        const preview = document.querySelector(`#preview${num}`);
        const label = document.querySelector(`label[for=upload${num}]`);
        const removeBtn = document.querySelector(`button[onclick="removeImage(${num})"]`);

        if (preview) {
            preview.src = '';
            preview.classList.add('hidden');
        }
        if (label) {
            label.classList.remove('hidden');
        }
        if (removeBtn) {
            removeBtn.classList.add('hidden');
        }

        // Reset the input field so a new image can be uploaded
        const input = document.getElementById('upload' + num);
        if (input) {
            input.value = '';
        }

        // Update the image count
        updateImageCount();
    }


</script>
@endsection