@extends('layout_admin.master')
@section('title', 'Create Article')
@section('content')
    @if($message = Session::get('success'))
        <div class="alert alert-success col-12 pt-2">
            {{$message}}
        </div>
    @endif
<a class="btn btn-default bg-secondary text-light mt-3 mb-3" href="{{ route('articles.create') }}">Create a new article</a>
<div class="card">
    <div class="card-header">
        <div class="row text-center">
            <div class="col-1">
                No.
            </div>
            <div class="col-3">
                Title
            </div>
            <div class="col-2">
                Author
            </div>
            <div class="col-2">
                Status
            </div>
            <div class="col-3">
                Time Public
            </div>
            <div class="col-1">
                Action
            </div>
        </div>
    </div>
    <div class="card-body">
        @foreach($articles as $article)
        <div class="row text-center pt-3">
            <div class="col-1">
                {{$loop->index + 1}}
            </div>
            <div class="col-3">
                {{$article->title}}
            </div>
            <div class="col-2">
                {{$article->author}}
            </div>
            <div class="col-2">
                {{$article->status}}
            </div>
            <div class="col-3">
                {{$article->time_public}}
            </div>
            <div class="col-1">
                <a href="{{route('articles.edit', $article->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <form class="d-inline" action="{{route('articles.destroy', $article->id)}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="border-0 bg-white text-primary">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection