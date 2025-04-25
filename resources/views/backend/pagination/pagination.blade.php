@if ($paginator->hasPages())
<nav class="mt-5" aria-label="Page navigation example">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item">
            <a class="page-link shadow-sm" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        @else
        <li lass="page-item">
            <a class="page-link shadow-sm" href="{{ $paginator->previousPageUrl() }}"
                aria-label="@lang('pagination.previous')">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        @endif

        {{-- Pagination Elements start --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-item" aria-disabled="true"><span>{{ $element }}</span></li>
        @endif
        {{-- Array of Links start --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item" aria-current="page">
            <span href="{{ $url }}" class="page-link shadow-sm bg-info">{{ $page }}</span>
        </li>
        @else
        <li class="page-item"><a href="{{ $url }}" class="page-link shadow-sm">{{ $page }}</a></li>
        @endif
        @endforeach
        {{-- Array of Links end --}}
        @endif
        {{-- Pagination Elements end --}}
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link shadow-sm" href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link shadow-sm" aria-label="@lang('pagination.next')">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
@endif