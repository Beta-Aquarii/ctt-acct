@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span class="pagination-buttons-left"><i class="fa fa-chevron-left white"></i></span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" class="pagination-buttons-left" rel="prev"><i class="fa fa-chevron-left white"></i></a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" class="pagination-buttons-right" rel="next"><i class="fa fa-chevron-right white"></i></a></li>
        @else
            <li class="disabled"><span class="pagination-buttons-right"><i class="fa fa-chevron-right white"></i></span></li>
        @endif
    </ul>
@endif
