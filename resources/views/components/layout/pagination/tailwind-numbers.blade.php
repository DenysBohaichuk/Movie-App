<nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0">
    <div class="-mt-px flex w-0 flex-1">
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                <svg class="mr-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z" clip-rule="evenodd" />
                </svg>
                Previous
            </a>
        @endif
    </div>


    <div class="md:-mt-px md:flex">
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="inline-flex items-center border-t-2 border-indigo-500 px-4 pt-4 text-sm font-medium text-indigo-600" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>

    <div class="-mt-px flex w-0 flex-1 justify-end">
        <div class="relative inline-block text-left pt-4 pr-4">
            <div>
                <button type="button" id="menu-button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3  text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" aria-expanded="false" aria-haspopup="true">
                    {{ request('perPage', 10) }}
                    <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div class="absolute right-0 z-10 my-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" hidden>
                <div class="py-1" role="none">
                    @foreach([10, 15, 20, 50, 100] as $perPageOption)
                        <a href="{{ request()->fullUrlWithQuery(['perPage' => $perPageOption]) }}" class="block px-4 py-2 text-sm hover:bg-gray-200 {{ request('perPage', 10) == $perPageOption ? 'bg-gray-100 text-gray-900' : '' }}" role="menuitem" tabindex="-1">
                            {{ $perPageOption }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                Next
                <svg class="ml-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                </svg>
            </a>
        @endif
    </div>
</nav>
