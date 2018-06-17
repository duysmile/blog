@extends('layout_admin.master')
@section('title', 'Create Article')
@section('content')
<a class="btn btn-default bg-secondary text-light mt-3 mb-3" href="{{ route('articles.create') }}">Create a new article</a>
<table class="table table-dark table-hover">
    <thead>
    <tr>
        <th>No.</th>
        <th>Title</th>
        <th>Time Created</th>
        <th>Author</th>
        <th>Views</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$article->title}}</td>
                <td>{{$article->created_at}}</td>
                <td>{{$article->author}}</td>
                <td>{{$article->views}}</td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection