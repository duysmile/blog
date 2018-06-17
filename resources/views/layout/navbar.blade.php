<nav class="pb-3">
    <div class="d-flex justify-content-between flex-wrap">
        @if (isset($categories))
            @foreach($categories as $category)
            <div class="nav-item">
                <a class="text-dark" href="">
                    {{$category->name}}
                </a>
            </div>
            @endforeach
        @endif
    </div>
</nav>