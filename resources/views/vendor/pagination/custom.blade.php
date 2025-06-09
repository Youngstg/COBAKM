@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-center mt-8">
        <ul class="flex items-center space-x-1 text-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-2 mx-6 font-semibold text-gray-300 rounded-md cursor-not-allowed">Prev</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-2 mx-6 font-semibold text-gasendra-blue hover:bg-blue-100 rounded-md transition duration-150 ease-in-out">Prev</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span class="px-3 py-2 font-semibold text-gasendra-blue bg-white border border-gasendra-blue rounded-md">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span aria-current="page"
                                      class="px-3 py-2 mx-1 font-semibold text-white bg-gasendra-blue rounded-md">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-3 py-2 mx-1 font-semibold text-gasendra-blue bg-white border border-gasendra-blue rounded-md hover:bg-gray-100 transition duration-150 ease-in-out">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-2 mx-6 font-semibold text-gasendra-blue hover:bg-gray-100 transition duration-150 ease-in-out">Next</a>
                </li>
            @else
                <li>
                    <span class="px-3 py-2 mx-6 text-gray-400 bg-white cursor-not-allowed">Next</span>
                </li>
            @endif
        </ul>
    </nav>
@endif