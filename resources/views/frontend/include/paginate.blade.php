@if ($paginator->hasPages())
    <div class="row w-100">
        <div class="col-lg-12">
            <div class="page-navigation-wrap mt-5">
                <div class="page-navigation w-100 text-center">
                    <ul class="page-navigation-nav m-auto">
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <a href="#" class="page-go page-prev">
                                    <i class="la la-arrow-left"></i>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $paginator->previousPageUrl() }}" class="page-go page-prev">
                                    <i class="la la-arrow-left"></i>
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
                                        <li class="active"><a href="#" class="page-go-link ">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $url }}" class="page-go-link">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li>
                                <a href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')"
                                   class="page-go page-next">
                                    <i class="la la-arrow-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                <a href="{{ $paginator->nextPageUrl() }}"
                                   class="page-go page-next">
                                    <i class="la la-arrow-right"></i>
                                </a>
                            </li>
                        @endif
                    </ul>

                </div>
            </div><!-- end page-navigation-wrap -->
        </div><!-- end col-lg-12 -->
    </div>
@endif
