@if ($paginator->hasPages())
    <nav
        role="navigation"
        aria-label="{{ __('Pagination Navigation') }}"
        class="flex justify-center items-center mt-4"
    >
        <span class="pagination-menu">
            @if ($paginator->onFirstPage())
                <span class="rounded-l-md pagination-item" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                    <i class="size-5" data-lucide="arrow-left"></i>
                </span>
            @else
                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    class="rounded-l-md pagination-item"
                    aria-label="{{ __('pagination.previous') }}"
                >
                    <i class="size-5" data-lucide="arrow-left"></i>
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span aria-disabled="true" class="pagination-item">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-disabled="true" aria-current="page" class="pagination-item">
                                <span class="text-center size-5">{{ $page }}</span>
                            </span>
                        @else
                            <a href="{{ $url }}" class="pagination-item" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                <span class="text-center size-5">{{ $page }}</span>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next"
                    class="rounded-r-md pagination-item"
                    aria-label="{{ __('pagination.next') }}"
                >
                    <i class="size-5" data-lucide="arrow-right"></i>
                </a>
            @else
                <span
                    aria-disabled="true"
                    aria-label="{{ __('pagination.next') }}"
                    class="rounded-r-md pagination-item"
                    aria-hidden="true"
                >
                    <i class="size-5" data-lucide="arrow-right"></i>
                </span>
            @endif
        </span>
    </nav>
@endif
