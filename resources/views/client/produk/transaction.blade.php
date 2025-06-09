@section('title', 'Pesanan')
<x-client>
    <x-header.ekraf></x-header.ekraf>
    <div class="container mx-auto px-4 md:px-12 md:py-8 py-5 md:mt-4 flex-grow min-h-[70vh]">
        <div class="flex items-center mb-8">
            <a href="{{ route('ecommerce.home') }}" class="no-underline text-2xl md:text-5xl leading-none mr-4">
                <i class="fas fa-chevron-left text-primary"></i>
            </a>
            <h1
                class="md:block hidden text-3xl md:text-6xl font-semibold bg-gradient-to-r from-primary to-gasendra-cream text-transparent bg-clip-text leading-none">
                PESANANKU
            </h1>
        </div>

        <!-- Add search form -->
        <form action="{{ route('ecommerce.order') }}" method="GET" class="mb-8">
            <div class="flex">
                <input type="text" name="search" placeholder="Cari pesanan berdasarkan ID..." value="{{ $search }}"
                    class="flex-grow px-4 md:py-2 py-1 border border-gray-300 rounded-l-md focus:outline-none focus:border-primary ">
                <button type="submit"
                    class="px-12 md:py-2 py-1 bg-primary text-white rounded-r-md hover:bg-primary-dark focus:outline-none focus:border-primary">
                    Cari
                </button>
            </div>
        </form>

        @if(empty($order) && !$search)
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center md:text-lg text-md">
                <p class="text-lg text-gray-600 mb-4 md:mb-0">Silakan cari pesanan Anda dengan memasukkan ID
                    pemesanan yang dikirim ke Email anda.</p>
            </div>
        @elseif(empty($order) && $search)
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center md:text-lg text-md">
                <p class="text-lg text-gray-600 mb-4 md:mb-0">Tidak ada pesanan ditemukan dengan ID: {{ $search }}</p>
            </div>
        @else
            <div class="space-y-4 md:text-base text-sm">
                @foreach($order as $details)
                    <div class="flex flex-col py-4 border-b border-gray-300">
                        <div class="flex items-center">
                            <div class="flex-grow">
                                <h3 class="md:text-lg text-base font-semibold">Pesanan #{{ $details['id'] }}</h3>
                                <div class="my-2">
                                    <p class="text-gray-500">Rincian Pembeli </p>
                                    <p>Nama : {{ $details['name'] }}</p>
                                    <p>Nomor Whatsapp : {{ $details['no_wa'] }}</p>
                                    <p>Email : {{ $details['email'] }}</p>
                                </div>
                                <p class="text-gray-500">Rincian Produk</p>
                                <ul>
                                    @foreach ($details['daftar_produk'] as $item)
                                        <li>
                                            <p>{{ $item['produk']['nama_produk'] }}
                                                • {{ $item['varian_produk']['nama_varian'] }} •
                                                {{ $item['varian_produk']['ukuran'] }} -
                                                Rp. {{  number_format($item['varian_produk']['harga'], 0, ',', '.') }}
                                                × {{ $item['jumlah'] }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                                <div
                                    class="rounded-md px-5 mt-3 py-2 bg-green-500 text-white cursor-default w-fit font-semibold">
                                    <p class="uppercase">telah {{ $details['payment']['status_pembayaran'] ?? "" }}</p>
                                </div>
                                <p class="mt-2">Note : Silahkan hubungi ke Email atau No WA yang tertera pada Bukti Pemesanan
                                    Anda untuk
                                    mendapatkan informasi lebih lanjut.</p>
                            </div>
                            <div class="text-right mt-2 min-w-[5rem] md:min-w-[10rem]">
                                <p class="font-medium">Total: <span class="font-semibold text-nowrap">Rp.
                                        {{ number_format($details['total_harga'], 0, ',', '.') }},-</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-client>
