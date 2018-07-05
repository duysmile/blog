    <div class="container">
        <div class="row bg-white">
            @if(count($topArticles) > 0)
            <div class="col-8 d-flex flex-column">
                <a href="{{route('content', [
                    'category' => count($topArticles[0]->categories) ? $topArticles[0]->categories[0]->name : 'no-category',
                    'article' => $topArticles[0]->title
                ])}}">
                    <img src="{{$topArticles[0]->images[0]->url}}" alt="" class="w-100 py-2">
                    <h2><b>{{$topArticles[0]->title}}</b></h2>
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
                </a>
            </div>
            @else
                <div class="alert alert-default">
                    No article here.
                </div>
            @endif
            @if(count($topArticles) > 1)
            <div class="col-4 d-flex flex-column">
                @foreach($topArticles as $key => $topArticle)
                    @if($key > 0)
                    <div class="w-100">
                        <a href="{{route('content', [
                            'category' => count($topArticle->categories) ? $topArticle->categories[0]->name : 'no-category',
                            'article' => $topArticle->title
                        ])}}">
                            <img src="{{$topArticle->images[0]->url}}" alt="" class="w-100 py-2">
                            <h4><b>{{$topArticle->title}}</b></h4>
                            <span>
                                <small class="mr-2">
                                    <i class="fa fa-user"></i><b>&nbsp;{{$topArticle->author}}</b>
                                </small>

                                <small>
                                    <i class="fa fa-clock"></i>&nbsp;{{date('d-m-Y', strtotime($topArticle->time_public))}}
                                </small>
                            </span>
                        </a>
                    </div>
                    @endif
                @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="container mt-2 pt-2">
        <div class="row">
            <div class="col-12 p-0">
                @foreach($articles->chunk(2) as $two_article)
                <div class="row">
                    @foreach($two_article as $key => $article)
                    <div class= "col-6 mt-2 main__card--height">
                        <div class="bg-white p-3 h-100">
                            <a href="{{route('content', [
                                'category' => count($article->categories) > 0 ? $article->categories[0]->name : 'no-category',
                                'article' => $article->title
                            ])}}">
                                <img src="{{$article->images[0]->url}}" alt="" class="w-100 py-2 main__image--height">
                                <h2><b>{{$article->title}}</b></h2>
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
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                @if(count($articles))
                    {{ $articles->links('layout.pagination') }}
                @endif
            </div>
        </div>
    </div>
