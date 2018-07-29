<div class="d-flex flex-column">
    @if(!count($articles))
        <div class="alert alert-default bg-white main__container--box-shadow">
            No articles here.
        </div>
    @endif
    @foreach($articles as $article)
    <div class="bg-white p-3 container-fluid main__container--box-shadow">
        <div class="row">
            <div class="col-5">
                <div class="flip">
                    <a href="{{route('content', [
                        'category' => count($article->categories) > 0 ? $article->categories[0]->name : 'no-category',
                        'article' => $article['title-en']
                    ])}}">
                        <img src="{{$article->images[0]->url}}" alt="" class="w-100">
                        <span class="flip-item"></span>
                        <span class="flip-read-more">
                            <img src="{{asset('images/bookmark.png')}}" alt="">
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-7">
                <a href="{{route('content', [
                    'category' => count($article->categories) > 0 ? $article->categories[0]->name : 'no-category',
                    'article' => $article['title-en']
                ])}}">
                    <h4 class="m-0">{{$article->title}}</h4>
                </a>
                <span>
                    <small class="mr-2">
                        <i class="fa fa-user"></i><b>&nbsp;{{$article->author}}</b>
                    </small>

                    <small>
                        <i class="fa fa-clock"></i>&nbsp;{{date('d-m-Y', strtotime($article->time_public))}}
                    </small>
                    <p>
                        {{$article->summary}}
                    </p>
                </span>
            </div>
        </div>
    </div>
    @endforeach
    @if(count($articles))
        {{ $articles->links('layout.pagination_number') }}
    @endif
</div>
