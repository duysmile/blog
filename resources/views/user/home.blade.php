@extends('layout.master')
@section('title', 'Home')
@section('main')
    @include('layout.main')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        @foreach ($articles as $key => $article)
            @if ($key != 0)
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$article->title}}</h5>
                            <p class="card-text">{!! $article->content !!}</p>
                            <a href="{{route('articles.show', $article->id)}}" class="btn btn-primary">Read more</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="row pb-3 pt-3" id="detail">
        @if(!empty($articles))
            <div class="col-8">
                <div class="d-flex justify-content-between">
                    <h2>
                        {{$articles[0]->title}}
                    </h2>
                </div>

                <hr>
                <p>
                    {!! $articles[0]->content !!}
                </p>
            </div>
        @endif
        @if(!empty($articles))
            <div class="col-4">
                <div class="bg-light p-3">
                    <h3>
                        About
                    </h3>
                    <p>
                        I'm {{$articles[0]->author}}
                    </p>

                </div>
            </div>
            {{$articles->links('layout.pagination')}}
        @endif
    </div>


@endsection