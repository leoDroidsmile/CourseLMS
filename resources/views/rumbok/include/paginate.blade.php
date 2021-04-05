@if ($paginator->hasPages())
    <div class="template-pagination">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled pagination-arrow" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a href="#">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
            @else
                <li class="pagination-arrow">
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="#" class="">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}" class="">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="pagination-arrow">
                    <a href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled pagination-arrow" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            @endif

        </ul>
    </div>

@endif
