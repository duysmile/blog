@extends('layout.master')
@section('title', 'Home')

@section('content')
    <div class="row pb-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif
        <div class="col-8">
            <div class="d-flex justify-content-between">
                <h2>
                    {{$article->title}}
                </h2>
                <div class="pr-1">
                    <a href="{{route('articles.edit', $article->id)}}" class="btn btn-default bg-light">
                        Edit
                    </a>
                </div>
                <div class="pr-1">
                    <form method="post" class="d-inline-block" action="{{route('articles.destroy', $article->id)}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="text-primary btn btn-default bg-light">
                            Delete
                        </button>
                    </form>
                </div>
                <div class="pr-1">
                    <a href="{{route('articles.index')}}" class="btn btn-default bg-light">
                        Back
                    </a>
                </div>
            </div>
            <hr>
            <p>
                {{$article->content}}
            </p>
        </div>
        <div class="col-4">
            <div class="bg-light p-3">
                <h3>
                    About
                </h3>
                <p>
                    I'm {{$article->id_author->name}}
                </p>
            </div>

        </div>
    </div>
@endsection