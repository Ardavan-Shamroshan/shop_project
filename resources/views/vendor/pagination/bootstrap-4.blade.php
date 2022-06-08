@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled px-1" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link shadow-sm rounded-circle" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item px-1">
                    <a class="page-link shadow-sm rounded-circle" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled px-1" aria-disabled="true"><span class="page-link shadow-sm rounded-circle">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active px-1" aria-current="page"><span class="page-link shadow-sm rounded-circle">{{ $page }}</span></li>
                        @else
                            <li class="page-item px-1"><a class="page-link shadow-sm rounded-circle" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item px-1">
                    <a class="page-link shadow-sm rounded-circle" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled px-1" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link shadow-sm rounded-circle" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
