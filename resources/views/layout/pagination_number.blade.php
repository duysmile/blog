@if ($paginator->lastPage() > 1)
    <ul class="pagination">
        <li class="{{ ($paginator->currentPage() == 1) ? ' sr-only' : '' }}">
            <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" class="btn btn-default bg-light">Previous</a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }} btn btn-default bg-light">
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' sr-only' : '' }}">
            <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="btn btn-default bg-light" >Next</a>
        </li>
    </ul>
@endif