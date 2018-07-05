@if ($paginator->lastPage() > 1)
    <ul class="pagination mt-2">
        <li class="{{ ($paginator->currentPage() == 1) ? ' sr-only' : '' }}">
            <a href="{{ $paginator->url(1) }}" class="text-light btn btn-default bg-secondary">Newer</a>
        </li>
        {{--@for ($i = 1; $i <= $paginator->lastPage(); $i++)--}}
            {{--<li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">--}}
                {{--<a href="{{ $paginator->url($i) }}">{{ $i }}</a>--}}
            {{--</li>--}}
        {{--@endfor--}}
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' sr-only' : '' }}">
            <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="text-light btn btn-default bg-secondary" >Older</a>
        </li>
    </ul>
@endif