@if ($paginator->hasPages())
    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
        <ul class="pagination">
            @if ($paginator->currentPage() == 1)
                <li class="paginate_button page-item previous disabled" id="example2_previous">
                    <a href="{{ array_first($elements)[1] }}" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">В начало</a>
                </li>                
            @else
                <li class="paginate_button page-item previous" id="example2_previous">
                    <a href="{{ array_first($elements)[1] }}" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">В начало</a>
                </li>                
            @endif

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="paginate_button page-item disabled">
                    <a href="{{ $paginator->previousPageUrl() }}" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">Назад</a>
                </li>                
            @else
                <li class="paginate_button page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">Назад</a>
                </li>                 
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="paginate_button page-item disabled">
                        <a href="{{ $url }}" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">{{ $element }}</a>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="paginate_button page-item active">
                                <a href="{{ $url }}" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">{{ $page }}</a>
                            </li>                            
                        @else
                            <li class="paginate_button page-item">
                                <a href="{{ $url }}" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">{{ $page }}</a>
                            </li> 
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="paginate_button page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">Вперёд</a>
                </li>  
            @else
                <li class="paginate_button page-item disabled">
                    <a href="{{ $paginator->previousPageUrl() }}" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">Вперёд</a>
                </li>             
            @endif

            @if ($paginator->currentPage() == $paginator->lastPage())
                <li class="paginate_button page-item next disabled" id="example2_next">
                    <a href="{{ array_last($elements)[$paginator->lastPage()] }}" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">В конец</a>
                </li>
            @else
                <li class="paginate_button page-item next" id="example2_next">
                    <a href="{{ array_last($elements)[$paginator->lastPage()] }}" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">В конец</a>
                </li>
            @endif        
        
        </ul>
    </div>

@endif
