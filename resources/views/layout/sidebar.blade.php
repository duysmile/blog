<div class="col-4 mt-3">
    <div class="bg-white ml-1 pt-4 px-3">
        <p class="text-center">
            RECENT POST
        </p>
        <hr>
        <div class="d-flex flex-column w-100">
            @foreach($recentArticles as $recentArticle)
            <div class="w-100 text-center">
                <img src="{{$recentArticle->images[0]->url}}" alt="" class="w-100">
                <b class=" d-block py-2">
                    {{$recentArticle->title}}
                </b>
            </div>
            @endforeach
        </div>
    </div>
    <div class="bg-white ml-1 py-4 px-3 mt-2">
        <p class="text-center">
            BLOG ARCHIE
        </p>
        <form action="">
            <div class="form-group">
                <select type="text" class="form-control">

                </select>
            </div>
        </form>
    </div>
    <div class="bg-white ml-1 pt-4 px-3 mt-2">
        <p class="text-center">
            POPULAR POST
        </p>
        <hr>
        <div class="d-flex flex-column w-100">
            @foreach($popularArticles as $popularArticle)
            <div class="w-100 text-center">
                <img src="{{$popularArticle->images[0]->url}}" alt="" class="w-100">
                <b class=" d-block py-2">
                    {{$popularArticle->title}}
                </b>
            </div>
            @endforeach
        </div>
    </div>
</div>