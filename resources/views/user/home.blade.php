{{--@extends('layout.master')--}}
{{--@section('title', 'Home')--}}
{{--@section('main')--}}
    {{--@include('layout.main')--}}
{{--@endsection--}}

{{--@section('content')--}}
    {{--@if ($message = Session::get('success'))--}}
        {{--<div class="alert alert-success">--}}
            {{--<p>{{ $message }}</p>--}}
        {{--</div>--}}
    {{--@endif--}}
    {{--<div class="row">--}}
        {{--@foreach ($articles as $key => $article)--}}
            {{--@if ($key != 0)--}}
                {{--<div class="col-6">--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-body">--}}
                            {{--<h5 class="card-title">{{$article->title}}</h5>--}}
                            {{--<p class="card-text">{!! $article->content !!}</p>--}}
                            {{--<a href="{{route('articles.show', $article->id)}}" class="btn btn-primary">Read more</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endif--}}
        {{--@endforeach--}}
    {{--</div>--}}

    {{--<div class="row pb-3 pt-3" id="detail">--}}
        {{--@if(!empty($articles))--}}
            {{--<div class="col-8">--}}
                {{--<div class="d-flex justify-content-between">--}}
                    {{--<h2>--}}
                        {{--{{$articles[0]->title}}--}}
                    {{--</h2>--}}
                {{--</div>--}}

                {{--<hr>--}}
                {{--<p>--}}
                    {{--{!! $articles[0]->content !!}--}}
                {{--</p>--}}
            {{--</div>--}}
        {{--@endif--}}
        {{--@if(!empty($articles))--}}
            {{--<div class="col-4">--}}
                {{--<div class="bg-light p-3">--}}
                    {{--<h3>--}}
                        {{--About--}}
                    {{--</h3>--}}
                    {{--<p>--}}
                        {{--I'm {{$articles[0]->author}}--}}
                    {{--</p>--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--{{$articles->links('layout.pagination')}}--}}
        {{--@endif--}}
    {{--</div>--}}


{{--@endsection--}}


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TorF's Blog</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>

<header class="container">
    <div class="row pt-3 pb-2 d-flex align-items-center">
        <div class="col-4">
            <h1>
                TorF's Blog
            </h1>
        </div>
        <div class="col-8">
            <img src="https://picsum.photos/730/100?image=0" alt="" class="img-responsive">
        </div>
    </div>
</header>
<nav class="border sticky-top bg-white">
    <div class="container">
        <div class="row">
            <div class="col-8 navbar navbar-expand ">
                <ul class="navbar-nav container">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Link</a>
                    </li>
                </ul>
            </div>
            <div class="col-3 offset-1 d-flex align-items-center justify-content-end">
                <div class="input-group">
                    <input class="form-control border-right-0 border" type="search" placeholder="Search" id="example-search-input">
                    <span class="input-group-append">
                        <button class="btn btn-outline-secondary border-left-0 border" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</nav>

<main class="bg-light pb-4">
    <div class="container">
        <div class="row pt-2">
            <div class="col-8 bg-white p-3">
                <div class="row">
                    <div class="col-8 d-flex flex-column">
                        <img src="https://picsum.photos/500/300?image=0" alt="" class="w-100 py-2">
                        <h2><b>Title Article</b></h2>
                        <span>
                            <small class="mr-2">
                                <i class="fa fa-user"></i><b>&nbsp;Duy</b>
                            </small>

                            <small>
                                <i class="fa fa-clock"></i>&nbsp;June 21,2018
                            </small>
                        </span>
                        <p class="text-justify">
                            <small>
                                Lorem ipsum dolor sit amet, fugiat harum iusto laborum libero numquam, odio quaerat quia quos sapiente velit voluptas!
                            </small>
                        </p>
                    </div>
                    <div class="col-4 d-flex flex-column">
                        <div class="w-100">
                            <img src="https://picsum.photos/500/300?image=0" alt="" class="w-100 py-2">
                            <h4><b>Title Article</b></h4>
                            <span>
                                <small class="mr-2">
                                    <i class="fa fa-user"></i><b>&nbsp;Duy</b>
                                </small>

                                <small>
                                    <i class="fa fa-clock"></i>&nbsp;June 21,2018
                                </small>
                            </span>
                        </div>
                        <div>
                            <img src="https://picsum.photos/500/300?image=0" alt="" class="w-100 py-2">
                            <h2><b>Title Article</b></h2>
                            <span>
                                <small class="mr-2">
                                    <i class="fa fa-user"></i><b>&nbsp;Duy</b>
                                </small>

                                <small>
                                    <i class="fa fa-clock"></i>&nbsp;June 21,2018
                                </small>
                            </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">

            </div>
        </div>
    </div>
    <div class="container pt-2">
        <div class="row">
            <div class="col-8 p-0">
                <div class="d-flex justify-content-between">
                    <div class="bg-white p-2 mr-3">
                        <img src="https://picsum.photos/500/300?image=0" alt="" class="w-100 py-2">
                        <h2><b>Title Article</b></h2>
                        <span>
                            <small class="mr-2">
                                <i class="fa fa-user"></i><b>&nbsp;Duy</b>
                            </small>

                            <small>
                                <i class="fa fa-clock"></i>&nbsp;June 21,2018
                            </small>
                        </span>
                        <p class="text-justify">
                            <small>
                                Lorem ipsum dolor sit amet, fugiat harum iusto laborum libero numquam, odio quaerat quia quos sapiente velit voluptas!
                            </small>
                        </p>
                    </div>
                    <div class="bg-white p-2">
                        <img src="https://picsum.photos/500/300?image=0" alt="" class="w-100 py-2">
                        <h2><b>Title Article</b></h2>
                        <span>
                            <small class="mr-2">
                                <i class="fa fa-user"></i><b>&nbsp;Duy</b>
                            </small>

                            <small>
                                <i class="fa fa-clock"></i>&nbsp;June 21,2018
                            </small>
                        </span>
                        <p class="text-justify">
                            <small>
                                Lorem ipsum dolor sit amet, fugiat harum iusto laborum libero numquam, odio quaerat quia quos sapiente velit voluptas!
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer class="container-fluid bg-white d-flex justify-content-center p-5">
    &copy;Duy Nguyen
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>