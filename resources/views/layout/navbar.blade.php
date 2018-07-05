<nav class="border sticky-top bg-white">
    <div class="container">
        <div class="row">
            <div class="col-8 navbar navbar-expand ">
                <ul class="navbar-nav container justify-content-start">
                    <li class="nav-item mr-2">
                        <a class="nav-link text-dark" href="{{route('home')}}">Home</a>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item mx-2">
                            <a class="nav-link text-dark" href="{{route('list', $category->name)}}">{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-3 offset-1 d-flex align-items-center justify-content-end">
                <form action="{{route('search')}}" class="form-inline border-none" method="get">
                    <div class="input-group">
                        <input class="form-control border-right-0 border" type="text" name="query" placeholder="Search" id="example-search-input">
                        <span class="input-group-append">
                            <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>