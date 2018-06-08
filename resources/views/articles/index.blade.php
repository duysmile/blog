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
    <div class="row pb-4">
        @foreach ($articles as $key => $article)
            @if ($key != 0)
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$article->title}}</h5>
                        <p class="card-text">{{$article->sum}}</p>
                        <a href="{{route('articles.show', $article->id)}}" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>

    <div class="row pb-3" id="detail">
        <div class="col-8">
            <div class="d-flex justify-content-between">
                <h2>
                    {{$articles[0]->title}}
                </h2>
                <div>
                    <a href="{{route('articles.edit', $articles[0]->id)}}" class="btn btn-default bg-light">
                        Edit
                    </a>
                    <form method="post" class="d-inline-block" action="{{route('articles.destroy', $articles[0]->id)}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="text-primary btn btn-default bg-light">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <hr>
            <p>
                {{$articles[0]->content}}
            </p>
        </div>
        <div class="col-4">
            <div class="bg-light p-3">
                <h3>
                    About
                </h3>
                <p>
                    I'm Nguyen Duy
                </p>
                <a href="{{route('articles.create')}}" class="bg-secondary text-light btn btn-default">
                    Create a new article
                </a>
            </div>
        </div>
        {{$articles->links('layout.pagination')}}
    </div>

@endsection