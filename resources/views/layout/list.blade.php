<div class="d-flex flex-column">
    @foreach($articles as $article)
    <div class="bg-white p-3 container-fluid">
        <div class="row">
            <div class="col-5">
                <a href="{{route('content', [
                    'category' => count($article->categories) > 0 ? $article->categories[0]->name : 'no-category',
                    'article' => $article->title
                ])}}">
                <img src="{{$article->images[0]->url}}" alt="" class="w-100">
                </a>
            </div>
            <div class="col-7">
                <a href="{{route('content', [
                    'category' => count($article->categories) > 0 ? $article->categories[0]->name : 'no-category',
                    'article' => $article->title
                ])}}">
                    <h4 class="m-0">{{$article->title}}</h4>
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
                </a>
            </div>
        </div>
    </div>
    @endforeach
    @if(count($articles))
        {{ $articles->links('layout.pagination_number') }}
    @endif
</div>
