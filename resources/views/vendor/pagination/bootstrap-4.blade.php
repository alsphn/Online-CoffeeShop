@if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span class="page-link" aria-hidden="true" style="font-size: 18px; padding: 6px 12px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">&lsaquo;</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" style="font-size: 18px; padding: 6px 12px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">&lsaquo;</a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-item disabled" aria-disabled="true"><span class="page-link" style="padding: 6px 12px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active" aria-current="page"><span class="page-link" style="padding: 6px 12px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">{{ $page }}</span></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $url }}" style="padding: 6px 12px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" style="font-size: 18px; padding: 6px 12px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">&rsaquo;</a>
        </li>
        @else
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="page-link" aria-hidden="true" style="font-size: 18px; padding: 6px 12px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">&rsaquo;</span>
        </li>
        @endif
    </ul>
</nav>

<style>
    .pagination {
        margin: 1rem 0;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        border-radius: 4px;
        border: 1px solid #dee2e6;
        color: #495057;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .pagination .page-link:hover {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .pagination .active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .pagination .disabled .page-link {
        background-color: #fff;
        border-color: #dee2e6;
        color: #6c757d;
    }
</style>
@endif