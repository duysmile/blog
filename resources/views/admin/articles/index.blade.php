@extends('layout_admin.master')
@section('title', 'Articles')
@section('content')
    <?php
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    ?>
    @if($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{$message}}
        </div>
    @endif
    @if($error = Session::get('error'))
        <div class="alert alert-danger mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{$error}}
        </div>
    @endif
    <div class="alert alert-success d-none mt-2" id="success_message">
        <button type="button" class="close" id="close_status">&times;</button>
        Update status successfully!
    </div>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-start">
                <a class="btn btn-default bg-secondary text-light my-3 mr-2" href="{{ route('articles.create') }}">
                    Create a new article
                </a>
                <a id="applyStatus" class="btn btn-default bg-secondary text-light my-3 mx-2">
                    Apply status
                </a>
                <form action="{{route('articles.search')}}" class="form-inline my-3 mx-2" method="get">
                    {{--<div class="input-group mr-1">--}}
                    {{--<select name="category" class="form-control">--}}
                    {{--<option value="" selected>--}}
                    {{---Category---}}
                    {{--</option>--}}
                    {{--@foreach($categories as $category)--}}
                    {{--<option value="{{$category->id}}">{{$category->name}}</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    <div class="input-group">
                        <input class="form-control border-right-0 border" name="query"
                               type="search" placeholder="Search" id="example-search-input">
                        <span class="input-group-append">
                <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mb-4 border">
        <div class="col-12 px-0">
            <div class="d-flex flex-column">
                <div class="bg-light p-2 border-bottom">
                    <div class="d-flex text-center">
                        <div class="col-1">
                            No.
                        </div>
                        <div class="col-2">
                            Title
                        </div>
                        @if(Auth::user()->roles[0]->name == 'admin')
                        <div class="col-1">
                            Author
                        </div>
                        <div class="col-1">
                            Top
                        </div>
                        @else
                        <div class="col-2">
                            Author
                        </div>
                        @endif
                        <div class="col-2">
                            Status
                        </div>
                        <div class="col-2">
                            Categories
                        </div>
                        <div class="col-2">
                            Time Public
                        </div>
                        <div class="col-1">
                            Action
                        </div>
                    </div>
                </div>
                <div class="pt-1 px-1">
                    @foreach($articles as $article)
                        <div class="d-flex text-center py-2 border-bottom">
                            <div class="col-1 pt-1">
                                {{$loop->index + 1}}
                            </div>
                            <div class="col-2 pt-1">
                                {{$article->title}}
                            </div>
                            @if(Auth::user()->roles[0]->name == 'admin')
                            <div class="col-1 pt-1">
                                {{$article->author}}
                            </div>
                            <div class="col-1">
                                <div class="pt-2">
                                    <label class="switch">
                                        <input type="checkbox" data-id="{{$article->id}}" name="top" value="true"
                                            @if($article->top)
                                               checked
                                            @endif
                                        >
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            @else
                            <div class="col-2 pt-1">
                                {{$article->author}}
                            </div>
                            @endif
                            <div class="col-2">
                                <select name="status" id="{{$article->id}}" class="form-control">
                                    @foreach($statuses as $status)
                                        @if($status->status_code == 2 && date(strtotime($article->time_public)) > time())
                                        @elseif($status->status_code == 1 && date(strtotime($article->time_public)) < time())
                                        @else
                                            <option value="{{$status->status_code}}"
                                                    @if ($status->status_code == $article->id_status)
                                                    selected
                                                    @endif
                                            >
                                                {{$status->name}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 pt-1">
                                @foreach($article->categories as $category)
                                    {{$category->name}} <br>
                                @endforeach
                            </div>
                            <div class="col-2 pt-1">
                                {{$article->time_public}}
                            </div>
                            <div class="col-1 pt-1">
                                <a href="{{route('articles.edit', $article->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="submit" class="border-0 bg-white"
                                        data-toggle="modal" data-target="#confirm{{$article->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        @component('layout_admin.components.modal_articles')
                            @slot('id')
                                {{$article->id}}
                            @endslot
                        @endcomponent
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if(count($articles))
    {{ $articles->links('layout_admin.pagination') }}
    @endif
<script>
    var listStatus = {};
    $(document).ready(function () {
        $('select').change(function () {
            let id = $(this).attr('id');
            let status = $(this).val();
            listStatus[id] = status;
        });
        $('#applyStatus').click(function () {
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url: "{{route('articles.updateStatus')}}",
                dataType: 'json',
                type: "PUT",
                contentType: 'application/json',
                data: JSON.stringify(listStatus),
                success: function (response) {
                    $('#success_message').removeClass('d-none');
                },
                error: function (error) {
                }
            });
        });
        $('#close_status').click(function(){
            $('#success_message').addClass('d-none');
        });
        const statusTop = {};
        $('input:checkbox').change(function () {
            statusTop.id = $(this).attr('data-id');
            statusTop.top = $(this).val();
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url: "{{route('articles.updateTop')}}",
                dataType: 'json',
                type: "PUT",
                contentType: 'application/json',
                data: JSON.stringify(statusTop),
                success: function (response) {
                },
                error: function (error) {
                }
            });
        });
    })
</script>
@endsection