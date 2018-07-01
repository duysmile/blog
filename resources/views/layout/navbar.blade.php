<nav class="border sticky-top bg-white">
    <div class="container">
        <div class="row">
            <div class="col-8 navbar navbar-expand ">
                <ul class="navbar-nav container justify-content-start">
                    <li class="nav-item mr-2">
                        <a class="nav-link text-dark" href="#">Home</a>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item mx-2">
                            <a class="nav-link text-dark" href="#">{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-3 offset-1 d-flex align-items-center justify-content-end">
                <div class="input-group">
                    <input class="form-control border-right-0 border" type="search" placeholder="Search" id="example-search-input">
                    <span class="input-group-append">
                        <button class="btn btn-outline-secondary border-left-0 border" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</nav>