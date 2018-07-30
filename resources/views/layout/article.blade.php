<div class="bg-white p-3 main__container--box-shadow">
    <h2><b>{{$article->title}}</b></h2>
    <span class="d-block mb-4">
        <small class="mr-2">
            <i class="fa fa-user"></i><b>&nbsp;{{$article->author->name}}</b>
        </small>

        <small>
            <i class="fa fa-clock"></i>&nbsp;{{date('d-m-Y', strtotime($article->time_public))}}
        </small>
    </span>
    <img src="{{$article->images[0]->url}}" alt="" class="w-100 mb-2">
    <p class="text-justify">
        <small>
            {!! $article->content !!}
        </small>
    </p>
</div>
<div class="bg-white p-3 mt-2 main__container--box-shadow">
    <p class="text-center">
        <i class="fa fa-thumbs-up"></i> YOU MAY ALSO LIKE
    </p>
    <hr>
    <div class="container-fluid">
        <div class="row">
            @foreach($articles_like as $article_like)
            <div class="col-md-4 col-12">
                <div class="flip">
                    <a href="{{route('content', [
                        'category' => count($article_like->categories) ? $article_like->categories[0]->name : 'no-category',
                        'article' => $article_like['title-en']
                    ])}}">
                        <img src="{{$article_like->images[0]->url}}" alt="" class="w-100 like__image--height">
                        <span class="flip-item"></span>
                        <span class="flip-read-more">
                            <img src="{{asset('images/bookmark.png')}}" alt="">
                        </span>
                    </a>
                </div>
                <a href="{{route('content', [
                        'category' => count($article_like->categories) ? $article_like->categories[0]->name : 'no-category',
                        'article' => $article_like['title-en']
                    ])}}">
                    <p class="text-center mt-2">
                        {{$article_like->title}}
                    </p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>