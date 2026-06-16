@if ($paginator->hasPages())
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center flex-wrap gap-1" style="margin-top: 8px;">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" style="background:#1e1e1e;border-color:#2d2d2d;color:#555;border-radius:8px;">&#8592;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   style="background:#2a2a2a;border-color:#3a3a3a;color:#d4af37;border-radius:8px;">&#8592;</a>
            </li>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link" style="background:#1e1e1e;border-color:#2d2d2d;color:#555;border-radius:8px;">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link"
                                  style="background:#d4af37;border-color:#d4af37;color:#111;font-weight:700;border-radius:8px;">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}"
                               style="background:#2a2a2a;border-color:#3a3a3a;color:#eaeaea;border-radius:8px;transition:.2s;"
                               onmouseover="this.style.background='#d4af37';this.style.color='#111';"
                               onmouseout="this.style.background='#2a2a2a';this.style.color='#eaeaea';">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                   style="background:#2a2a2a;border-color:#3a3a3a;color:#d4af37;border-radius:8px;">&#8594;</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" style="background:#1e1e1e;border-color:#2d2d2d;color:#555;border-radius:8px;">&#8594;</span>
            </li>
        @endif

    </ul>
    <p class="text-center mt-2" style="font-size:.78rem;color:#555;letter-spacing:.06em;">
        Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }} results
    </p>
</nav>
@endif
