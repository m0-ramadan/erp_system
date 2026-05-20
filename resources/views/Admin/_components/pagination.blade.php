@if($paginator->hasPages())
    @php
        $pageLinks = $paginator->linkCollection()->slice(1, max($paginator->linkCollection()->count() - 2, 0));
    @endphp
    <div class="m-3 qw-pagination">
        <nav aria-label="Pagination Navigation">
            <ul class="pagination mb-0">
                @if($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link waves-effect" aria-hidden="true">‹</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link waves-effect" href="{{ $paginator->previousPageUrl() }}" rel="prev">‹</a>
                    </li>
                @endif

                @foreach($pageLinks as $link)
                    @if($link['label'] === '...')
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link waves-effect">…</span>
                        </li>
                    @elseif($link['active'])
                        <li class="page-item active" aria-current="page">
                            <span class="page-link waves-effect">{{ $link['label'] }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link waves-effect" href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        </li>
                    @endif
                @endforeach

                @if($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link waves-effect" href="{{ $paginator->nextPageUrl() }}" rel="next">›</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link waves-effect" aria-hidden="true">›</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
