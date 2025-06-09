@section('title', 'E-Commerce')
<x-client>
    <x-header.ekraf></x-header.ekraf>
    <header class="relative w-full text-white">
        <div class="w-full">
            <div class="swiper header-carousel">
                <div class="swiper-wrapper">
                    @foreach($carousels as $carousel)
                        <div class="swiper-slide">
                            <img class="w-full h-[34rem] object-cover" src="{{ asset('storage/' . $carousel->image_path) }}"
                                alt="{{ $carousel->title }}">
                        </div>
                    @endforeach
                </div>
                <div
                    class="swiper-pagination !absolute !bottom-4 !left-[18rem] !transform !-translate-x-1/2 !flex !items-center !w-auto">
                </div>
            </div>
        </div>
    </header>

    <section class="container mx-auto px-4 md:px-12 md:py-8 py-5 md:mt-4 flex-grow min-h-[69vh]">
        <h2
            class="bg-gradient-to-r from-primary to-gasendra-cream inline-block text-transparent bg-clip-text text-xl md:text-6xl font-semibold mb-2 md:mb-8">
            EKRAF <span class="font-normal">E-COMMERECE</span>
        </h2>
        <!-- Form search function -->
        <form action="{{ route('ecommerce.home') }}" method="GET" class="mb-4">
            <div class="flex">
                <input type="text" name="search" placeholder="Cari Produk..." value="{{ $search ?? '' }}"
                    class="flex-grow px-4 md:py-2 py-1 border border-gray-300 rounded-l-md focus:outline-none focus:border-primary">
                <button type="submit"
                    class="md:px-12 px-6 md:py-2 py-1 bg-primary text-white rounded-r-md hover:bg-primary-dark focus:outline-none focus:border-primary">
                    Search
                </button>
            </div>
        </form>

        <!-- Display search results -->
        @if(isset($search) && $search)
            <p class="mb-4">Search results for: "{{ $search }}"</p>
        @endif
        <div class="mb-2 md:mb-8 grid grid-cols-4 md:gap-8 ">
            <button
                class="category border-primary border-2 py-1 md:py-2 md:px-2 rounded-sm hover:bg-primary hover:font-bold text-[.6em] md:text-[1em] active"
                data-category="all">
                Semua Produk
            </button>
        </div>

        <div class="product grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-8 mb-4" id="products">
            @foreach($products as $product)
                    <div class="product relative" data-category="{{ $product->category }}" data-aos="fade-up"
                        data-aos-duration="1000">
                        <a href="{{ route('ecommerce.product.show', $product->id) }}"
                            class="block h-full transition-transform duration-200 ease-in-out hover:-translate-y-1">
                            <div class="flex flex-col gap-1 lg:gap-2 h-full">
                                <img src="{{ $product->photos->isNotEmpty()
                ? asset('storage/' . $product->photos->first()->url_photo)
                : asset('assets/images/Mask group.png') }}" alt="{{ $product->nama_produk ?? 'Product Image' }}"
                                    class="w-full h-auto object-cover object-center rounded-xl md:rounded-md" loading="lazy">
                                <h3 class="text-sm lg:text-lg md:text-base font-bold">
                                    {{ $product->nama_produk }}
                                </h3>
                                <p class="text-primary text-2xl md:text-3xl lg:text-4xl font-bold">
                                    @if($product->varianProduk->isNotEmpty())
                                        Rp {{ number_format(optional($product->varianProduk->first())->harga ?? 0, 0, ',', '.') }}
                                    @else
                                        Rp. 0
                                    @endif
                                </p>
                                <p class="text-sm lg:text-lg md:text-base line-clamp-2">
                                    {{ \Illuminate\Support\Str::limit($product->deskripsi, $limit = 150, $end = '...') }}
                                </p>
                            </div>
                        </a>
                    </div>
            @endforeach
        </div>
        @if($products->isEmpty())
            <p class="text-center text-gray-500">No products found.</p>
        @endif
        <div>
            {{ $products->links() }}
        </div>
    </section>
</x-client>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryButtons = document.querySelectorAll('.category');
        const products = document.querySelectorAll('.product');

        categoryButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove active class from all buttons
                categoryButtons.forEach(btn => btn.classList.remove('bg-primary', 'font-bold'));

                // Add active class to the clicked button
                this.classList.add('bg-primary', 'font-bold');

                // Get the selected category
                const category = this.getAttribute('data-category');

                // Show/hide products based on the selected category
                products.forEach(product => {
                    if (category === 'all' || product.getAttribute('data-category') === category) {
                        product.style.display = 'grid';
                    } else {
                        product.style.display = 'none';
                    }
                });
            });
        });

        // swiper carousel
        new Swiper('.header-carousel', {
            loop: true,
            autoplay: {
                delay: 5000,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                renderBullet: function (index, className) {
                    return `<span class="${className} !w-[4rem] !h-[0.4rem] !bg-white !bg-opacity-80 !rounded-md !mx-1 !inline-block"></span>`;
                },
            },
        });
        const style = document.createElement('style');
        // Add custom styles for active bullet
        style.textContent = `
        .swiper-pagination-bullet-active {
            background-opacity: 4 !important;
            width: 2rem !important;
        }
    `;
        document.head.appendChild(style);

        // Simulate click on the "All Product" button to show all products by default
        document.querySelector('.category[data-category="all"]').click();
    });
</script>