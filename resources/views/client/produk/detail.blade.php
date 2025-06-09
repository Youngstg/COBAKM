@section('title', 'Detail Produk')

<x-client>
    @include('sweetalert::alert')
    <x-header.ekraf></x-header.ekraf>
    <div class="container max-w-6xl mx-auto p-2 md:p-6 md:px-12 md:py-12">
        <div class="container mx-auto px-4 md:px-12 md:py-8 py-4 flex-grow">
            <div class="flex items-center mb-8">
                <a href="{{ route('ecommerce.home') }}" class="no-underline text-2xl md:text-5xl leading-none mr-4">
                    <i class="fas fa-chevron-left text-primary"></i>
                </a>
                <h1
                    class="text-3xl md:block hidden md:text-6xl font-bold bg-gradient-to-r from-primary to-gasendra-cream text-transparent bg-clip-text leading-none">
                    DETAIL <span
                        class="font-thin bg-gradient-to-r from-primary to-gasendra-cream text-transparent bg-clip-text">PRODUK</span>
                </h1>
            </div>

            <div class="border-b border-gray-300 flex flex-col lg:flex-row gap-6">
                <!-- Image Gallery -->
                <div class="lg:w-1/2 flex flex-col">
                    <div class="flex flex-col-reverse md:flex-row gap-4 flex-auto md:pb-8">
                        <div class="w-1/5 flex flex-row md:flex-col gap-7">
                            @forelse($product->photos as $photo)
                                <img src="{{ asset('storage/' . $photo->url_photo) }}"
                                    alt="Thumbnail of {{ $product->nama_produk }}"
                                    class="w-auto h-24 object-cover cursor-pointer rounded-md md:rounded-3xl thumbnail"
                                    loading="lazy" />
                            @empty
                                <img src="{{ asset('assets/images/Mask group.png') }}" alt="Default Thumbnail"
                                    class="w-auto h-24 object-cover cursor-pointer rounded-md md:rounded-3xl thumbnail"
                                    loading="lazy" />
                            @endforelse
                        </div>
                        <div class="w-full md:w-[400px] h-full md:rounded-2xl rounded-md relative overflow-hidden"
                            x-data="{ isZoomed: false }">
                            <img id="mainImage" :class="isZoomed ? 'scale-150' : ''" @click="isZoomed = !isZoomed"
                                src="{{ $product->photos->isNotEmpty() ? asset('storage/' . $product->photos->first()->url_photo) : asset('assets/images/Mask group.png') }}"
                                alt="Product Image of {{ $product->nama_produk }}"
                                class="main-image md:h-[30em] object-cover transition-transform duration-300" />
                            <button class="absolute bottom-4 right-4" aria-label="Zoom image"
                                @click="isZoomed = !isZoomed">
                                <img src="{{ asset('assets/images/search-icon.svg') }}" alt="Search Icon"
                                    class="w-8 h-8" />
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Product Details -->
                <div class="flex flex-col justify-between">
                    <div class="lg:w-auto flex flex-col">
                        <h1 class="md:text-4xl text-3xl lg:text-5xl font-bold mb-2">{{ $product->nama_produk }}</h1>
                        <div class="mb-4 text-sm md:text-base text-slate-400">
                            <span id="stock">{{ $product->varianProduk->first()->stok ?? 'N/A' }}</span>
                            <span>Stok Tersedia</span>
                        </div>
                        <div class="mb-5">
                            <div class="flex justify-between items-center mb-2">
                                <p class="font-semibold text-sm md:text-base">Pilih Ukuran</p>
                                <a href="#"
                                    class="font-semibold text-sm md:text-base text-gray-500 hover:text-primary transition-colors duration-200">Panduan
                                    Ukuran</a>
                            </div>
                            <div class="flex flex-wrap gap-y-2 text-sm md:text-base">
                                @foreach($product->varianProduk as $variant)
                                    <button
                                        class="text-black font-semibold size-btn border border-primary px-3 py-2 md:px-6 mr-4 rounded-md hover:bg-primary transition-colors duration-200"
                                        data-variant-id="{{ $variant->id }}" data-size="{{ $variant->ukuran }}"
                                        onclick="selectSize(this)">{{ $variant->ukuran }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="md:flex grid grid-cols-2 flex-wrap justify-end md:gap-4 gap-2 mb-8 items-center">
                        <p id="price" class="text-2xl col-span-2 md:text-2xl font-bold text-black">Rp
                            {{ number_format($product->varianProduk->first()->harga ?? 0, 0, ',', '.') }}
                        </p>
                        <form action="{{ route('ecommerce.cart', $product->id) }}" method="get" class="">
                            @csrf
                            <input type="hidden" name="variant_id" id="selectedVariantIdCheckout">
                            <input name="id" value="{{ $product->id }}" type="hidden">
                            <button
                                class="bg-primary text-black text-sm md:text-base font-semibold w-full md:px-6 py-3 rounded-md hover:bg-primary-dark transition-colors duration-200"
                                type="submit">Beli Langsung</button>
                        </form>
                        <form action="{{ route('ecommerce.cart.add', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="variant_id" id="selectedVariantId">
                            <button type="submit"
                                class="border-2 border-black text-black text-sm md:text-base w-full font-semibold md:px-6 py-3 rounded-md hover:bg-primary transition-colors duration-200">Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="mt-12">
                <h2 class="md:text-2xl text-xl font-semibold mb-4">Rincian Produk</h2>
                <p class="text-gray-700 leading-relaxed md:text-base text-sm">{{ $product->deskripsi }}</p>
            </div>
        </div>
</x-client>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    let selectedSize = null;
    let selectedVariantId = @json($product->varianProduk[0]->id);
    const productVariants = @json($product->varianProduk);

    document.querySelectorAll('.size-btn').forEach((btn) => {
        if (btn.getAttribute('data-variant-id') == selectedVariantId) {
            btn.classList.add('bg-primary');
            selectedSize = btn.getAttribute('data-size');
            updatePriceAndStock(selectedVariantId);
            document.getElementById('selectedVariantId').value = selectedVariantId;
            document.getElementById('selectedVariantIdCheckout').value = selectedVariantId;
        }
    });

    function selectSize(button) {
        document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('bg-primary'));
        button.classList.add('bg-primary');

        selectedSize = button.getAttribute('data-size');
        selectedVariantId = button.getAttribute('data-variant-id');
        updatePriceAndStock(selectedVariantId);
        document.getElementById('selectedVariantId').value = selectedVariantId;
        document.getElementById('selectedVariantIdCheckout').value = selectedVariantId;
    }

    function updatePriceAndStock(variantId) {
        const variant = productVariants.find(v => v.id === parseInt(variantId));
        if (variant) {
            document.getElementById('price').textContent = `Rp ${numberFormat(variant.harga)}`;
            document.getElementById('stock').textContent = variant.stok;
        }
    }

    function numberFormat(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    function setSelectedVariant() {
        document.getElementById('selectedVariantId').value = selectedVariantId;
        document.getElementById('selectedVariantIdCheckout').value = selectedVariantId;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function () {
                mainImage.src = this.src;
            });
        });

        mainImage.addEventListener('click', function () {
            this.classList.toggle('zoom');
        });
    });
</script>
