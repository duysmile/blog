<nav class="border sticky-top bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-8 navbar navbar-expand py-0">
                <ul class="navbar-nav container justify-content-start">
                    <li class="nav-item">
                        <a class="sticky-logo" href="{{route('home')}}">
                            <b>
                                TorF
                            </b>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-dropdown-hover p-3" href="{{route('home')}}">
                            Home
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li class="nav-item custom-dropdown">
                            <a class="nav-link custom-dropdown-hover p-3"
                               href="{{route('list', $category->name)}}">
                                {{$category->name}}
                            </a>
                            @if(count($category->child))
                                <div class="custom-dropdown-menu">
                                    @foreach($category->child as $child)
                                        <a class="custom-dropdown-item p-2 pl-3"
                                           href="{{route('list', $child->name)}}">
                                            {{$child->name}}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div id="search-box" class="col-4 align-items-center justify-content-end d-flex">
                <form action="{{route('search')}}" class="form-inline border-none" method="get">
                    <div class="input-group">
                        <input class="form-control border-right-0 border" type="text" name="query" placeholder="Search" id="example-search-input">
                        <span class="input-group-append">
                            <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                                <i class="fa fa-search text-light"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>
<script>
    $(document).ready(function(){
        function checkOffsetTopNavbar(){
            if($(".sticky-top").offset().top > $("header").height()){
                $(".sticky-logo").css('min-width', '3em');
                $(".sticky-logo").css('color', 'white');
                $("#search-box").addClass('nav__search-box--top');
            }
            else{
                $(".sticky-logo").css('min-width', '0');
                $(".sticky-logo").css('color', '#343a40');
                $("#search-box").removeClass('nav__search-box--top');
            }
        }
        checkOffsetTopNavbar();
        $(window).scroll(function () {
            checkOffsetTopNavbar();
        })
    })
</script>