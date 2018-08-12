<header class="container">
    <div class="row pt-3 pb-2 d-flex align-items-center">
        <div class="col-md-4 col-12">
            <h1>
                <a id="logo" href="{{route('home')}}">
                    TorF's Blog
                </a>
            </h1>
        </div>        
        <div class="col-md-8 d-md-flex d-none align-items-center justify-content-end">
            <div class="p-2 text-blue">
                <a href="">
                    <i class="fa fa-facebook-square mr-2 header__i--font-size"></i>
                </a>
                <a href="">
                    <i class="fa fa-linkedin header__i--font-size"></i>
                </a>
            </div>
            <form action="{{route('search')}}" class="form-inline border-none" method="get">
                <div class="input-group w-100">
                    <input class="form-control border-right-0 border" type="text" name="query" placeholder="Search">
                    <span class="input-group-append">
                        <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</header>