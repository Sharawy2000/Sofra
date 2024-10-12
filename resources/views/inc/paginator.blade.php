<style>
    .pagination-container {
    text-align: center;
    margin: 20px 0;
}

.pagination {
    display: inline-flex;
    padding-left: 0;
    list-style: none;
    border-radius: 4px;
}

.pagination li {
    margin: 0 2px;
}

.pagination li a, .pagination li span {
    color: #007bff;
    padding: 6px 12px;
    text-decoration: none;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.pagination li a:hover {
    background-color: #e9ecef;
}

.pagination li.active span {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.pagination li.disabled span {
    color: #6c757d;
    pointer-events: none;
    background-color: #f8f9fa;
}
</style>
@if ($paginator->hasPages())
    <nav class="pagination-container">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>&laquo; Previous</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Previous</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($paginator->links()->elements as $element)
            
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next &raquo;</a></li>
            @else
                <li class="disabled"><span>Next &raquo;</span></li>
            @endif
        </ul>
    </nav>
@endif
