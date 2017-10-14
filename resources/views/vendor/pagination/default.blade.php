@if ($paginator->hasPages())
    <div class="dataTables_wrapper ">
        <div class="dataTables_paginate" >
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="paginate_button previous disabled" >上一页</a>
            @else
                <a class="paginate_button previous" href="{{ $paginator->previousPageUrl() }}" rel="prev">上一页</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span><a class="paginate_button current disabled" >{{ $element }}</a></span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span><a class="paginate_button current" href="###">{{ $page }}</a></span>
                        @else
                            <span><a class="paginate_button" href="{{ $url }}">{{ $page }}</a></span>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a  href="{{ $paginator->nextPageUrl() }}" rel="next" class="paginate_button next disabled" >下一页</a>
            @else
                <a class="paginate_button next disabled" >下一页</a>
            @endif
        </div>
    </div>
@endif
