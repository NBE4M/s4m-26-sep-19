    @if ($paginator->hasPages())
        <div class="pagination pagination-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="prev page-numbers"><i class="fa fa-caret-left"></i>Previous Page</a>
                
            @else
                <a class="prev page-numbers" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-caret-left"></i>Previous Page</a>
               
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="page-numbers current" >{{ $page }}</a>
                        @else
                            <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                            
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}">Next Page<i class="fa fa-caret-right"></i></a>
                
            @else
                <a class="next page-numbers" >Next Page<i class="fa fa-caret-right"></i></a>
            @endif
         </div>
    @endif