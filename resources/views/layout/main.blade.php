<div class="container">
    @if(count($topArticles) > 0)
        <div class="row bg-white mb-2 pb-2 main__container--box-shadow">
            <div class="col-md-12 bg-dark p-2 mb-3">
                <i class="text-white fa fa-align-justify p-2 pr-0">
                </i>
                <h5 class="d-inline-block text-white pt-1">
                    TOP
                </h5>
            </div>
            <div class="col-md-8 col-12 d-flex flex-column">
                <div class="flip mb-2">
                    <a href="{{route('content', [
                        'category' => count($topArticles[0]->categories) ? $topArticles[0]->categories[0]->name : 'no-category',
                        'article' => $topArticles[0]['title-en']
                    ])}}">
                        <img src="{{$topArticles[0]->images[0]->url}}" alt="" class="w-100">
                        <span class="flip-item"></span>
                        <span class="flip-read-more">
                            <img src="{{asset('images/bookmark.png')}}" alt="">
                        </span>
                    </a>
                </div>
                <div>
                    <a href="{{route('content', [
                                            'category' => count($topArticles[0]->categories) ? $topArticles[0]->categories[0]->name : 'no-category',
                                            'article' => $topArticles[0]['title-en']
                                        ])}}">
                        <h2 class="text-justify"><b>{{$topArticles[0]->title}}</b></h2>
                    </a>
                    <span>
                                            <small class="mr-2">
                                                <i class="fa fa-user"></i><b>&nbsp;{{$topArticles[0]->author}}</b>
                                            </small>

                                            <small>
                                                <i class="fa fa-clock"></i>&nbsp;{{date('d-m-Y', strtotime($topArticles[0]->time_public))}}
                                            </small>
                                        </span>
                    <p class="text-justify">
                        <small>
                            {{$topArticles[0]->summary}}
                        </small>
                    </p>
                </div>
            </div>
            @if(count($topArticles) > 1)
                <div class="col-md-4 col-12 d-flex flex-column">
                    @foreach($topArticles as $key => $topArticle)
                        @if($key > 0)
                            <div class="w-100">
                                <div class="flip mb-2">
                                    <a href="{{route('content', [
                                                            'category' => count($topArticle->categories) ? $topArticle->categories[0]->name : 'no-category',
                                                            'article' => $topArticle['title-en']
                                                        ])}}">
                                        <img src="{{$topArticle->images[0]->url}}" alt="" class="w-100">
                                        <span class="flip-item"></span>
                                        <span class="flip-read-more">
                                                                <img src="{{asset('images/bookmark.png')}}" alt="">
                                                            </span>
                                    </a>
                                </div>
                                <div>
                                    <a href="{{route('content', [
                                                            'category' => count($topArticle->categories) ? $topArticle->categories[0]->name : 'no-category',
                                                            'article' => $topArticle['title-en']
                                                        ])}}">
                                        <h6 class="text-justify"><b>{{$topArticle->title}}</b></h6>
                                    </a>
                                    <span>
                                                            <small class="mr-2">
                                                                <i class="fa fa-user"></i><b>&nbsp;{{$topArticle->author}}</b>
                                                            </small>

                                                            <small>
                                                                <i class="fa fa-clock"></i>&nbsp;{{date('d-m-Y', strtotime($topArticle->time_public))}}
                                                            </small>
                                                        </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>
<div class="container">
    <div class="row mt-4">
        <div class="col-12 bg-dark p-2 mb-3">
            <i class="text-white fa fa-angle-double-right p-2 pr-0">
            </i>
            <h5 class="d-inline-block text-white pt-1">
                LATEST
            </h5>
        </div>
        <div class="col-12">
            @if(!count($articles))
                <div class="alert alert-default bg-white main__container--box-shadow">
                    No article here.
                </div>
            @else
                @foreach($articles->chunk(2) as $two_article)
                    <div class="row d-flex justify-content-between">
                        @foreach($two_article as $key => $article)
                            <div class= "col-md-6 col-12 mb-3">
                                <div class="bg-white p-3 h-100 main__container--box-shadow">
                                    <div class="flip">
                                        <a href="{{route('content', [
                                                                'category' => count($article->categories) > 0 ? $article->categories[0]->name : 'no-category',
                                                                'article' => $article['title-en']
                                                            ])}}">
                                            <img src="{{$article->images[0]->url}}" alt=""
                                                 class="w-100 main__image--height flip">
                                            <span class="flip-item"></span>
                                            <span class="flip-read-more">
                                                                    <img src="{{asset('images/bookmark.png')}}" alt="">
                                                                </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{route('content', [
                                                                'category' => count($article->categories) > 0 ? $article->categories[0]->name : 'no-category',
                                                                'article' => $article['title-en']
                                                            ])}}">
                                            <h5><b>{{$article->title}}</b></h5>
                                        </a>
                                        <span>
                                                                <small class="mr-2">
                                                                    <i class="fa fa-user"></i><b>&nbsp;{{$article->author}}</b>
                                                                </small>

                                                                <small>
                                                                    <i class="fa fa-clock"></i>&nbsp;{{date('d-m-Y', strtotime($article->time_public))}}
                                                                </small>
                                                            </span>
                                        <p class="text-justify">
                                            <small>
                                                {{$article->summary}}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
            @if(count($articles))
                {{ $articles->links('layout.pagination') }}
            @endif
        </div>
    </div>
</div>