<!-- Blade Template -->
@section('tittle', 'Organisasi Mahasiswa ITERA | KM ITERA Official Website')

<x-client>
    <!-- Header -->
    <div class="">
        <div class="bg-cover bg-bottom bg-no-repeat rounded-xl m-4 h-96 bg-primary-beranda">
            <h1
                class="text-3xl pt-20 sm:text-4xl lg:text-6xl font-bold mb-6 sm:mb-10 text-center uppercase text-gasendra-blue-primary">
                Organisasi Mahasiswa ITERA
            </h1>
            <div
                class="relative lg:w-full max-w-[46rem] mb-[11.6rem] w-3/4 md:w-1/2 mx-auto flex items-center bg-transparant">
                <i class="fa-solid fa-magnifying-glass w-5 h-5 sm:w-7 sm:h-7 absolute md:mt-3 mt-1 left-3 sm:left-5"></i>
                <form action="{{ route('client.ormawa.index') }}" method="GET" class="w-full">
                    <input type="text" id="search-input" name="search" placeholder="Cari organisasi disini"
                        value="{{ $search }}"
                        class="w-full px-10 sm:px-12 py-3 sm:py-4 my-4 rounded-full font-normal tracking-wider text-center text-sm sm:text-base focus:outline focus:outline-gasendra-blue" />
                    <input type="hidden" name="activeTab" id="activeTabInput" value="{{ $activeTab }}">
                </form>
            </div>
        </div>
        <div class="from-[#C5E5ED] via-[#AEE9FC] to-[#D0EAF1] text-center py-6 px-4 flex gap-2 md:block">
            <button id="btn-hmps"
                class="font-semibold w-full md:w-auto md:px-28 py-3 rounded-lg border shadow-slate-400 border-gasendra-blue text-white bg-gasendra-blue transition-all duration-300 hover:bg-gasendra-blue">
                HMPS
            </button>
            <button id="btn-ukm"
                class="font-semibold w-full md:w-auto md:px-28 py-3 rounded-lg border shadow-slate-400 border-gasendra-blue text-white bg-gasendra-blue transition-all duration-300 hover:bg-gasendra-blue">
                UKM
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div id="ormawa-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden ">
        <div class="bg-white rounded-lg shadow-lg w-[90%] lg:max-w-6xl md:max-w-2xl p-4 sm:p-6 lg:p-8">
            <div class="flex justify-between items-center mb-4 sm:mb-6">
                <h1 id="modal-title"
                    class="text-2xl sm:text-3xl lg:text-4xl font-bold mx-auto text-gasendra-blue-primary"></h1>
                <button id="close-modal" class="text-xl"><i class="fas fa-times fa-lg sm:fa-2x"></i></button>
            </div>
            <img id="modal-image" src="" alt="Logo"
                class="w-40 h-40 sm:w-60 sm:h-60 lg:w-[300px] lg:h-[300px] mb-4 mx-auto object-contain">
            <div class="space-y-3 sm:space-y-4">
                <p class="text-sm sm:text-base"><strong>Ketua Himpunan:</strong> <span id="modal-ketua"></span></p>
                <p class="text-sm sm:text-base"><strong>Dies Natalis:</strong> <span id="modal-dies-natalis">Not
                        available</span></p>
                <p class="text-sm sm:text-base"><strong>Link Website:</strong>
                    <a id="modal-website" href="#" target="_blank" class="underline text-blue-500 break-all"></a>
                </p>
                <p class="text-sm sm:text-base">
                    <strong>Deskripsi:</strong> <span id="modal-details">No description available</span>
                </p>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pt-6 sm:pt-10">
                    <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                        <a id="modal-instagram" href="#" target="_blank" class="hidden">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
                                alt="Instagram" class="w-8 sm:w-[35px]">
                        </a>
                        <a id="modal-linkedin" href="#" target="_blank" class="hidden">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f8/LinkedIn_icon_circle.svg"
                                alt="LinkedIn" class="w-8 sm:w-[35px]">
                        </a>
                        <a id="modal-youtube" href="#" target="_blank" class="hidden">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/4/42/YouTube_icon_%282013-2017%29.png"
                                alt="YouTube" class="w-8 sm:w-[35px]">
                        </a>
                    </div>
                    <button id="modal-close"
                        class="bg-gasendra-yellow-primary text-white font-semibold px-4 py-2 rounded inline-block text-sm sm:text-base">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- HMPS Content -->
    <div id="content-hmps"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mt-8 mx-6">
        @foreach ($hmps as $item)
            <div class="bg-gray-100 rounded-lg shadow-md p-4 sm:p-6 flex flex-col HMPS-item" data-aos="fade-up"
                data-aos-duration="1500">
                <img src="{{ asset('storage/' . $item->image) }}" alt="Logo"
                    class="w-32 h-32 sm:w-40 sm:h-40 lg:w-52 lg:h-52 mb-4 mx-auto object-contain">
                <h3 class="text-base sm:text-lg font-semibold mb-2 text-center text-gasendra-blue-primary">
                    {{ $item->name }}
                </h3>
                <p class="text-xs sm:text-sm text-black mb-4 text-center">Ketua Himpunan: {{ $item->ketua }}</p>
                <div
                    class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-2 text-center font-semibold mt-auto">
                    <a href="{{ $item->website }}"
                        class="bg-neutral-50 text-black px-3 py-2 rounded w-full flex items-center justify-center text-sm">
                        Website <i class="fas fa-arrow-right -rotate-45 ml-2"></i>
                    </a>
                    <button class="bg-gasendra-yellow-primary text-white px-3 py-2 rounded w-full text-sm detail-button"
                        data-ormawa="{{ json_encode($item) }}">
                        Detail
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- UKM Content -->
    <div id="content-ukm"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mt-8 mx-6 {{ $activeTab === 'UKM' ? '' : 'hidden' }}">
        @foreach ($ukms as $item)
            <div class="bg-gray-100 rounded-lg shadow-md p-4 sm:p-6 flex flex-col UKM-item" data-aos="fade-up"
                data-aos-duration="1500">
                <img src="{{ asset('storage/' . $item->image) }}" alt="Logo"
                    class="w-32 h-32 sm:w-40 sm:h-40 lg:w-52 lg:h-52 mb-4 mx-auto object-contain">
                <h3 class="text-base sm:text-lg font-semibold mb-2 text-center text-gasendra-blue-primary">
                    {{ $item->name }}
                </h3>
                <p class="text-xs sm:text-sm text-black mb-4 text-center">Ketua: {{ $item->ketua }}</p>
                <div
                    class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-2 text-center font-semibold mt-auto">
                    <a href="{{ $item->website }}"
                        class="bg-neutral-50 text-black px-3 py-2 rounded w-full flex items-center justify-center text-sm">
                        Website <i class="fas fa-arrow-right -rotate-45 ml-2"></i>
                    </a>
                    <button class="bg-gasendra-yellow-primary text-white px-3 py-2 rounded w-full text-sm detail-button"
                        data-ormawa="{{ json_encode($item) }}">
                        Detail
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        <div id="pagination-hmps" class="{{ $activeTab === 'HMPS' ? '' : 'hidden' }}">
            {{ $hmps->withQueryString()->links('pagination::tailwind') }}
        </div>
        <div id="pagination-ukm" class="{{ $activeTab === 'UKM' ? '' : 'hidden' }}">
            {{ $ukms->withQueryString()->links('pagination::tailwind') }}
        </div>
    </div>


    <script>
        // Active Tab
        let activeTab = "{{ $activeTab }}";

         document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            let activeTab = urlParams.get('activeTab') || "{{ $activeTab }}";

            const contentHMPS = document.getElementById('content-hmps');
            const contentUKM = document.getElementById('content-ukm');
            const paginationHMPS = document.getElementById('pagination-hmps');
            const paginationUKM = document.getElementById('pagination-ukm');
            const btnHMPS = document.getElementById('btn-hmps');
            const btnUKM = document.getElementById('btn-ukm');
            const modal = document.getElementById('ormawa-modal');
            const closeModal = document.getElementById('close-modal');
            const modalClose = document.getElementById('modal-close');

            function setActiveTab(tab) {
                if (tab === 'UKM') {
                    contentHMPS.classList.add('hidden');
                    contentUKM.classList.remove('hidden');
                    paginationHMPS.classList.add('hidden');
                    paginationUKM.classList.remove('hidden');
                    btnHMPS.classList.remove('bg-gasendra-blue', 'text-white');
                    btnHMPS.classList.add('bg-white', 'text-gasendra-blue', 'hover:bg-opacity-30');
                    btnUKM.classList.add('bg-gasendra-blue', 'text-white');
                    btnUKM.classList.remove('bg-white', 'text-gasendra-blue', 'hover:bg-opacity-30');
                } else {
                    contentHMPS.classList.remove('hidden');
                    contentUKM.classList.add('hidden');
                    paginationHMPS.classList.remove('hidden');
                    paginationUKM.classList.add('hidden');
                    btnUKM.classList.remove('bg-gasendra-blue', 'text-white');
                    btnUKM.classList.add('bg-white', 'text-gasendra-blue', 'hover:bg-opacity-30');
                    btnHMPS.classList.add('bg-gasendra-blue', 'text-white');
                    btnHMPS.classList.remove('bg-white', 'text-gasendra-blue', 'hover:bg-opacity-30');
                }
            }

            setActiveTab(activeTab);

            btnHMPS.addEventListener('click', () => {
                activeTab = 'HMPS';
                setActiveTab(activeTab);
            });

            btnUKM.addEventListener('click', () => {
                activeTab = 'UKM';
                setActiveTab(activeTab);
            });

            // Preserve active tab when paginating
            document.querySelectorAll('.pagination-wrapper a').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const url = new URL(link.href);
                    url.searchParams.set('activeTab', activeTab);
                    window.location.href = url.toString();
                });
            });

            // Handle detail button click
            document.querySelectorAll('.detail-button').forEach(button => {
                button.addEventListener('click', () => {
                    const ormawa = JSON.parse(button.getAttribute('data-ormawa'));
                    document.getElementById('modal-title').textContent = ormawa.name;
                    document.getElementById('modal-image').src = `/storage/${ormawa.image}`;
                    document.getElementById('modal-ketua').textContent = ormawa.ketua;
                    document.getElementById('modal-dies-natalis').textContent = ormawa.dies_natalis || 'Not available';
                    document.getElementById('modal-website').href = ormawa.website;
                    document.getElementById('modal-website').textContent = ormawa.website;
                    document.getElementById('modal-details').textContent = ormawa.description || 'No description available';

                    // Show/hide social media links
                    document.getElementById('modal-instagram').classList.toggle('hidden', !ormawa.instagram);
                    document.getElementById('modal-instagram').href = ormawa.instagram || '#';
                    document.getElementById('modal-linkedin').classList.toggle('hidden', !ormawa.linkedin);
                    document.getElementById('modal-linkedin').href = ormawa.linkedin || '#';
                    document.getElementById('modal-youtube').classList.toggle('hidden', !ormawa.youtube);
                    document.getElementById('modal-youtube').href = ormawa.youtube || '#';

                    modal.classList.remove('hidden');
                });
            });

            // Close modal
            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            modalClose.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });
    </script>
</x-client>
