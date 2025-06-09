@section('title', 'Keranjang Belanja')

<x-client>
    <x-header.ekraf></x-header.ekraf>
    <div class="container mx-auto px-4 md:px-12 md:py-8 py-5 md:mt-4 flex-grow min-h-[69vh]">
        <div class="flex items-center mb-4">
            <a href="{{ route('ecommerce.home') }}" class="no-underline text-2xl md:text-5xl leading-none mr-4">
                <i class="fas fa-chevron-left text-primary"></i>
            </a>
            <h1 class="md:block hidden text-3xl md:text-6xl font-bold bg-gradient-to-r from-primary to-gasendra-cream text-transparent bg-clip-text leading-none">
                KERANJANG <span
                        class="font-thin bg-gradient-to-r from-primary to-gasendra-cream text-transparent bg-clip-text">BELANJA</span>
            </h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <div class="lg:col-span-3">
                @if(empty($updatedCartItems))
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <p class="text-lg text-gray-600 mb-4 md:mb-0">Keranjang Anda kosong!</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($updatedCartItems as $id => $details)
                            <div class="flex flex-col py-4 border-b border-gray-300">
                                <div class="flex items-center">
                                    <img src="{{ $details['photo_url'] ? asset('storage/' . $details['photo_url']) : asset('assets/images/Mask group.png') }}"
                                         alt="{{ $details['name'] ?? 'Product Image' }}"
                                         class="w-24 h-28 object-cover mr-4 rounded-lg">
                                    <div class="flex-grow">
                                        <h3 class="text-lg font-semibold">{{ $details['name'] }}</h3>
                                        <p class="text-gray-600">
                                            Rp. {{ number_format($details['price'], 0, ',', '.') }},-</p>
                                        <p class="text-gray-500">Varian: {{ $details['variant'] }}</p>
                                        <p class="text-gray-500">Ukuran: {{ $details['ukuran'] }}</p>
                                    </div>
                                    <div class="flex items-center font-semibold">
                                        @if ($details['quantity'] === 1)
                                            <form action="{{ route('ecommerce.cart.remove', $id) }}" method="POST"
                                                  class="ml-6">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-500 border mr-3 border-gray-300 p-1 rounded"
                                                        aria-label="Remove item">
                                                    <img src="{{ asset('assets/images/trash.svg', true) }}"
                                                         class="h-6 md:w-auto w-12 pe-0"
                                                         alt="Delete"/>
                                                </button>
                                            </form>
                                        @endif


                                        <form action="{{ route('ecommerce.cart.update', $id) }}" method="POST"
                                              class="flex items-center">
                                            @csrf
                                            @method('PUT')

                                            <!-- Decrease Button -->
                                            @if ($details['quantity'] !== 1)
                                                <button type="submit" name="quantity"
                                                        value="{{ $details['quantity'] - 1 }}"
                                                        class="px-2 py-1 mr-3 border border-gray-300 rounded"
                                                        aria-label="Decrease quantity"
                                                        {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>
                                                    -
                                                </button>
                                            @endif
                                            <p>{{ $details['quantity'] }}</p>
                                            <!-- Increase Button -->
                                            <button type="submit" name="quantity"
                                                    value="{{ $details['quantity'] + 1 }}"
                                                    class="px-2 ml-3 py-1 border border-gray-300 rounded"
                                                    aria-label="Increase quantity"
                                                    {{ $details['quantity'] >= min($details['max_stock'], 99) ? 'disabled' : '' }}>
                                                +
                                            </button>
                                        </form>

                                    </div>
                                </div>
                                <div class="text-right mt-2">
                                    <p class="font-medium">Total Harga: <span class="font-semibold">Rp.
                                            {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }},-</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="lg:col-span-2">
                @if(!empty($updatedCartItems))
                    <form action="{{ route('ecommerce.transaksi.create') }}" method="POST">
                        @csrf
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                            <h2 class="md:text-2xl text-xl font-semibold mb-4">Detail Pembayaran</h2>
                            <div class="mb-4">
                                <label for="nama-lengkap" class="text-black font-medium mb-2">Nama Lengkap <span class="text-red-600">*</span></label>
                                <input type="text" id="nama-lengkap" name="nama"
                                       class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Masukkan nama lengkap anda" required>
                                        <p>Mohon masukkan Nama Lengkap Anda untuk kelengkapan administrasi.</p>
                            </div>
                            <div class="mb-4">
                                <label for="nomor-telepon" class="text-black font-medium mb-2">Nomor Telepon <span class="text-red-600">*</span></label>
                                <input type="text" id="nomor-telepon" name="no_wa"
                                       class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Masukkan nomor telepon anda" required>
                                        <p>Mohon masukkan No WA <strong>aktif</strong> Anda untuk mendapatkan informasi pengambilan barang.</p>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="text-black font-medium mb-2">Email <span class="text-red-600">*</span></label>
                                <input type="email" id="email" name="email"
                                       class="w-full px-3 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Masukkan email aktif anda" required>
                                    <p>Mohon masukkan Email <strong>aktif</strong> Anda untuk mendapatkan bukti pesanan Anda.</p>
                            </div>

                        </div>
                @endif
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-4">
                            <h2 class="md:text-2xl text-xl font-semibold mb-4">Ringkasan Belanja</h2>
                            @if(empty($updatedCartItems))
                                <p class="text-gray-600">Ringkasan belanja kosong</p>
                            @else
                                <div class="space-y-5">
                                    <div class="flex justify-between">
                                        <span>Total Harga</span>
                                        <span>Rp. {{ number_format($subtotal, 0, ',', '.') }}</span>
                                    </div>
                                    <!-- <div class="flex justify-between">
                                                                                                    <span>Pengiriman</span>
                                                                                                    <span>Free</span>
                                                                                                </div> -->
                                    <div class="flex justify-between">
                                        <span>Total Diskon</span>
                                        <span>Rp. {{ number_format($discount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Biaya Admin</span>
                                        <span>Rp. {{ number_format($tax, 0, ',', '.') }}</span>
                                    </div>
                                    <hr class="h-px my-8 bg-black border-0"/>
                                    <div class="flex justify-between font-semibold text-lg">
                                        <span>Total Belanja</span>
                                        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if(!empty($updatedCartItems))
                            <button type="submit"
                                    class="w-full bg-primary text-black font-semibold py-3 rounded-lg hover:bg-[#d9a93e] transition-colors duration-300">
                                Bayar
                            </button>
                        @endif
                    </form>
                    @if(empty($updatedCartItems))
                        <a href="{{ route('ecommerce.home') }}"
                           class="inline-block px-6 py-2 bg-primary text-black font-semibold rounded-lg hover:bg-[#d9a93e] transition-colors duration-300">
                            Lanjut Belanja
                        </a>
                    @endif
            </div>
        </div>
    </div>
</x-client>
