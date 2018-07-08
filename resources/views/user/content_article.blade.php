@extends('layout.master')
@if($article != null)
    @section('title', $article->title)
@else
    @section('title', 'Error')
@endif
@section('main')
    @include('layout.article')
@endsection