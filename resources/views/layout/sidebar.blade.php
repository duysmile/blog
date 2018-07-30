<div class="col-md-4 col-12 mt-3">
    <div class="bg-white ml-1 pt-4 px-3 main__container--box-shadow">
        <p class="text-center">
            <i class="fa fa-calendar text-dark"></i>
            RECENT POST
        </p>
        <hr>
        <div class="d-flex flex-column w-100">
            @foreach($recentArticles as $recentArticle)
                <div class="w-100 text-center">
                    <div class="flip">
                        <a href="{{route('content', [
                                            'category' => count($recentArticle->categories) ? $recentArticle->categories[0]->name : 'no-category',
                                            'article' => $recentArticle['title-en']
                                        ])}}">
                            <img src="{{$recentArticle->images[0]->url}}" alt="" class="w-100">
                            <span class="flip-item"></span>
                            <span class="flip-read-more">
                                                <img src="{{asset('images/bookmark.png')}}" alt="">
                                            </span>
                        </a>
                    </div>
                    <div>
                        <a href="{{route('content', [
                                            'category' => count($recentArticle->categories) ? $recentArticle->categories[0]->name : 'no-category',
                                            'article' => $recentArticle['title-en']
                                        ])}}">
                            <b class=" d-block py-2">
                                {{$recentArticle->title}}
                            </b>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="bg-white ml-1 py-4 px-3 mt-3 main__container--box-shadow">
        <p class="text-center">
            <i class="fa fa-bell text-dark"></i>
            BLOG ARCHIE
        </p>
        <form action="{{route('time')}}" method="get" id="blog_archie_form">
            <div class="form-group">
                <select type="text" class="form-control" name="time" id="blog_archie">
                    <option value="" disabled selected hidden>--Blog Archie--</option>
                    @foreach($time_public as $time)
                        <option value="{{$time->value}}">{{$time->date}}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    <div class="bg-white ml-1 pt-4 px-3 mt-3 main__container--box-shadow">
        <p class="text-center">
            <i class="fa fa-trophy text-dark"></i>
            POPULAR POST
        </p>
        <hr>
        <div class="d-flex flex-column w-100">
            @foreach($popularArticles as $popularArticle)
                <div class="w-100 text-center">
                    <div class="flip">
                        <a href="{{route('content', [
                                            'category' => count($popularArticle->categories) ? $popularArticle->categories[0]->name : 'no-category',
                                            'article' => $popularArticle['title-en']
                                        ])}}">
                            <img src="{{$popularArticle->images[0]->url}}" alt="" class="w-100">
                            <span class="flip-item"></span>
                            <span class="flip-read-more">
                                                <img src="{{asset('images/bookmark.png')}}" alt="">
                                            </span>
                        </a>
                    </div>
                    <div>
                        <a href="{{route('content', [
                                            'category' => count($popularArticle->categories) ? $popularArticle->categories[0]->name : 'no-category',
                                            'article' => $popularArticle['title-en']
                                        ])}}">
                            <b class=" d-block py-2">
                                {{$popularArticle->title}}
                            </b>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#blog_archie").change(function () {
            $("#blog_archie_form").submit();
        })
    })
</script>