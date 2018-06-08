<main>
    <div class="jumbotron d-flex">
        <div class="row">
            <div class="col-6 text-justify">
                @if (!empty($articles))
                <h1>
                    {{$articles[0]->title}}
                </h1>
                <p>
                    {{$articles[0]->sum}}
                </p>
                <a href="#detail">
                    Continue reading ...
                </a>
                @else
                <h1>
                    No Article here
                </h1>
                <a href="#detail">
                    Continue reading ...
                </a>
                @endif
            </div>
        </div>
    </div>
</main>