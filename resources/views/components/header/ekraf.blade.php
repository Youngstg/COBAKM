<div class="relative text-white">
    <nav class="absolute top-4 items-center lg:right-20 md:right-10 right-3 z-10 max-w-[115rem]">
        <div class="flex gap-x-2 items-center">
            <a href="{{ route('ecommerce.order') }}"
                class="md:p-2 p-1 text-sm md:text-lg rounded-full bg-primary hover:bg-yellow-600">
                Pesananku
            </a>
            <a href="{{ route('ecommerce.cart') }}" class="p-2 bg-primary rounded-full hover:bg-yellow-600">
                <img class="icon-cart h-[1em] md:h-[2em]" src="{{ asset('assets/images/mdi_cart-outline.png') }}"
                    alt="icon cart">
            </a>
        </div>
    </nav>
    @yield('script')
</div>
